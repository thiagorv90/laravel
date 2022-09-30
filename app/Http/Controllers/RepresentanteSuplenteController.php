<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representante_suplente;
use App\Models\Vw_representatentes;
use App\Models\Representante_suplentes_anexo;
use App\Models\Telefone_representante_suplente;
use DB;
use App\Models\Empresa;
use App\Models\Escolaridade;
use APP\Models\user;
use App\Models\Representacoe;
use Illuminate\Pagination\LengthAwarePaginator;


class RepresentanteSuplenteController extends Controller
{
    public function repsupindex()
    {
        return view('repsup/repsup', ['representante_suplente' => $events]);
    }

    public function repsupstore(Request $request)
    {
        $event = new Representante_suplente;
        $event->nmRepresentanteSuplente = $request->nmRepresentanteSuplente;
        $event->dsEmail = $request->dsEmail;
        $event->dsEmailAlternativo = $request->dsEmailAlternativo;
        $event->stAtivo = $request->stAtivo;
        $event->dsProfissao = $request->dsProfissao;
        $event->cdEscolaridade = $request->cdEscolaridade;
        $event->cdEmpresa = $request->cdEmpresa;
        $event->dsEndereco = $request->dsEndereco;
        $event->dtNascimento = $request->dtNascimento;

        $event->dsBairro = $request->dsBairro;
        $event->dsCidade = $request->dsCidade;
        $event->dsCEP = $request->dsCEP;


        $event->save();

        if ($request->has('nmAnexo')) {
            for ($i = 0; $i < count($request->allFiles()['nmAnexo']); $i++) {
                $file = $request->allfiles()['nmAnexo'][$i];
                $name = $request->file()['nmAnexo'][$i]->getClientOriginalName();
                $anexo = new Representante_suplentes_anexo();

                $explode = $file->store('public/files');
                $certo = explode("s/", $explode);

                $anexo->nmAnexo = $certo[1];
                $anexo->nmOriginal = $name;
                $anexo->cdRepSup = $event->cdRepSup;

                $anexo->save();
            }
        }

        return redirect()->route('representantes');
    }

    public function repsupfile(Request $request, $id)
    {
        for ($i = 0; $i < count($request->allFiles()['nmAnexo']); $i++) {
            $file = $request->allfiles()['nmAnexo'][$i];
            $name = $request->file()['nmAnexo'][$i]->getClientOriginalName();
            $anexo = new Representante_suplentes_anexo();

            $explode = $file->store('public/files');
            $certo = explode("s/", $explode);

            $anexo->nmAnexo = $certo[1];
            $anexo->nmOriginal = $name;
            $anexo->cdRepSup = $id;

            $anexo->save();
        }
        return back();
    }

    public function deleteRep($id)
    {
        $links = Representante_suplentes_anexo::where('cdRepSup', $id)->get();

        foreach ($links as $link) {
            unlink(public_path() . "/storage/files/$link->nmAnexo");
        }

        Representante_suplentes_anexo::where('cdRepSup', $id)->delete();
        Representante_suplente::where('cdRepSup', $id)->delete();
        // $deleted = DB::delete('delete from telefone_contatos where cdTelefone = ?', [$id]);
        return back();
    }

    public function deleteRepImg($id)
    {
        $file = Representante_suplentes_anexo::where('nmAnexo', $id);

        unlink(public_path() . "/storage/files/$id");

        Representante_suplentes_anexo::where('nmAnexo', $id)->delete();

        // $deleted = DB::delete('delete from telefone_contatos where cdTelefone = ?', [$id]);
        return back();
    }

    public function repsupcreate()
    {
        $events = DB::table('vw_representantes')->orderby('nmRepresentanteSuplente')->simplepaginate(10);

        $dados = DB::table('users')->get();
        $empresas = DB::table('empresas')->get();
        $escolaridades = DB::table('escolaridades')->get();

        return view('repsup/repsup', ['empresas' => $empresas, 'escolaridades' => $escolaridades, 'dados' => $dados, 'events' => $events]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required',
        ]);

        $query = $request->input('query');
        $events = DB::table('vw_representantes')
            ->where('nmRepresentanteSuplente', 'like', "%$query%")
            ->get();

        return view('/repsup/search-results', compact('events'));
    }

    public function editRepSup($id)
    {
        //$events=Instituicoe::find($id);
        $edit = Representante_suplente::join('escolaridades', 'escolaridades.cdEscolaridade', '=', 'representante_suplentes.cdEscolaridade')
            ->join('empresas', 'empresas.cdEmpresa', '=', 'representante_suplentes.cdEmpresa')
            ->where('cdRepSup', '=', $id)
            ->get();
        // $insta = Instituicoe::join('tipo_instancias', 'tipo_instancias.cdTipoInstancia', '=','instituicoes.cdTipoInstituicao')->get();
        $insta = Empresa::orderBy('cdEmpresa')
            ->get();
        $escola = Escolaridade::orderBy('cdEscolaridade')
            ->get();
        $anexo = Representante_suplente::join('representante_suplentes_anexos', 'representante_suplentes_anexos.cdRepSup', '=', 'representante_suplentes.cdRepSup')->where('representante_suplentes.cdRepSup', '=', $id)->get();
        return view('repsup.edit', ['selecionado' => $edit, 'lista' => $insta, 'escola' => $escola, 'anexo' => $anexo]);
    }

    public function updateRepSup(Request $request, $id)
    {
        $nome = $request->input('nmRepresentanteSuplente');
        $email = $request->input('dsEmail');
        $emaila = $request->input('dsEmailAlternativo');
        $sta = $request->input('stAtivo');
        $prof = $request->input('dsProfissao');
        $escola = $request->input('cdEscolaridade');
        $empresa = $request->input('cdEmpresa');
        $ende = $request->input('dsEndereco');
        $data = $request->input('dtNascimento');
        $obs = $request->input('dsObservacao');
        $bairro = $request->input('dsBairro');
        $cidade = $request->input('dsCidade');
        $cep = $request->input('dsCEP');

        DB::update('update representante_suplentes set  nmRepresentanteSuplente = ?, dsEmail = ?, dsEmailAlternativo = ?,
        stAtivo = ?, dsProfissao = ?, cdEscolaridade = ?, cdEmpresa = ?, dsEndereco = ?, dtNascimento =?, dsObservacao=?,dsBairro = ?, dsCidade =?,dsCEP=?
        where cdRepSup = ?', [$nome, $email, $emaila, $sta, $prof, $escola, $empresa, $ende, $data, $obs, $bairro, $cidade, $cep, $id]);

        return redirect('/repsup')->with('msg', 'evento alterado com sucesso');
    }

    public function selerepsup($id)
    {
        $events = Representante_suplente::all();
        $dados = DB::table('users')->get();
        $empresas = DB::table('empresas')->get();
        $escolaridades = DB::table('escolaridades')->orderby('dsEscolaridade')->get();
        $selecionado = Representacoe::join('representante_suplentes', 'representacoes.cdTitular', '=', 'representante_suplentes.cdRepSup')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->join('instituicoes', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
            ->where('instituicoes.cdInstituicao', '=', $id)
            ->get();
        return view('repsup.selerepsup', ['events' => $events, 'dados' => $dados, 'empresas' => $empresas, 'escolaridades' => $escolaridades, 'selecionado' => $selecionado]);
    }

}
