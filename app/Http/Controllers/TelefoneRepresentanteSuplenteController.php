<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Telefone_representante_suplente;
use DB;
use App\Models\Representante_suplente;

class TelefoneRepresentanteSuplenteController extends Controller
{
    public function telrepsupstore(Request $request)
    {
        $event = new Telefone_representante_suplente;

        $event->cdRepSup = $request->cdRepSup;
        $event->nuDDDTelefone = $request->nuDDDTelefone;
        $event->nuTelefone = $request->nuTelefone;
        $event->tpTelefone = $request->tpTelefone;

        $event->save();

        return back();
    }

    public function telrepsupcreate($id)
    {
        $telefones = DB::table('representante_suplentes')->where('cdRepSup', '=', $id)->get();
        $events = Telefone_representante_suplente::all();
        $selecionado = Telefone_representante_suplente::join('representante_suplentes', 'representante_suplentes.cdRepSup', '=', 'telefone_representante_suplentes.cdRepSup')
            ->where('representante_suplentes.cdRepSup', '=', $id)
            ->get();

        return view('telrepsup/telrepsup', ['telefones' => $telefones, 'events' => $events, 'selecionado' => $selecionado]);
    }

    public function editTrel($id)
    {
        //$events=Instituicoe::find($id);
        $edit = Telefone_representante_suplente::join('representante_suplentes', 'telefone_representante_suplentes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->where('cdTelefone', '=', $id)
            ->get();
        // $insta = Instituicoe::join('tipo_instancias', 'tipo_instancias.cdTipoInstancia', '=','instituicoes.cdTipoInstituicao')->get();
        $insta = Representante_suplente::orderBy('nmRepresentanteSuplente')
            ->get();
        return view('telrepsup.edit', ['selecionado' => $edit, 'lista' => $insta]);
    }

    public function updateTrel(Request $request, $id)
    {
        $cd = $request->input('cdRepSup');
        $name = $request->input('nuDDDTelefone');
        $nu = $request->input('nuTelefone');
        $tp = $request->input('tpTelefone');

        DB::update('update Telefone_representante_suplentes set cdRepSup = ?, nuDDDTelefone = ?, nuTelefone = ?, tpTelefone=? where cdTelefone = ?', [$cd, $name, $nu, $tp, $id]);

        return redirect('/telrepsup')->with('msg', 'evento alterado com sucesso');
    }

    public function deleteTrel($id)
    {
        Telefone_representante_suplente::find($id)->delete();
        // $deleted = DB::delete('delete from telefone_contatos where cdTelefone = ?', [$id]);
        return back();
    }
}
