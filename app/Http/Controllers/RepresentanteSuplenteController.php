<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representante_suplente;
use DB;
use App\Models\Empresa;
use App\Models\escolaridade;
use APP\Models\user;
use App\Models\representacoe;


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
        $event->save();

        return redirect('/');
    }

    public function repsupcreate()
    {
        $events = Representante_suplente::all();
        $dados = DB::table('users')->get();
        $empresas = DB::table('empresas')->get();
        $escolaridades = DB::table('escolaridades')->get();
        return view('repsup/repsup', compact('empresas', 'escolaridades', 'dados', 'events'));
    }

    public function editRepSup($id)
    {
        //$events=Instituicoe::find($id);
        $edit = Representante_suplente::join('escolaridades', 'escolaridades.cdEscolaridade', '=', 'representante_suplentes.cdEscolaridade')
            ->join('empresas', 'empresas.cdEmpresa', '=', 'representante_suplentes.cdEmpresa')
            ->where('cdRepSup', '=', $id)
            ->get();
        // $insta = Instituicoe::join('tipo_instancias', 'tipo_instancias.cdTipoInstancia', '=','instituicoes.cdTipoInstituicao')->get();
        $insta = empresa::orderBy('cdEmpresa')
            ->get();
        $escola = escolaridade::orderBy('cdEscolaridade')
            ->get();
        return view('repsup.edit', ['selecionado' => $edit, 'lista' => $insta, 'escola' => $escola]);
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

        DB::update('update representante_suplentes set  nmRepresentanteSuplente = ?, dsEmail = ?, dsEmailAlternativo = ?,
        stAtivo = ?, dsProfissao = ?, cdEscolaridade = ?, cdEmpresa = ?, dsEndereco = ?, dtNascimento =?
        where cdRepSup = ?', [$nome, $email, $emaila, $sta, $prof, $escola, $empresa, $ende, $data, $id]);

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
