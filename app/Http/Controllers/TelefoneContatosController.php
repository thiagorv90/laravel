<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Telefone_contato;
use DB;
use App\Models\contato;

class TelefoneContatosController extends Controller
{
    public function telconstore(Request $request)
    {
        $event = new Telefone_contato;
        $event->cdContatoTelefone = $request->cdContatoTelefone;
        $event->nuDDDTelefone = $request->nuDDDTelefone;
        $event->nuTelefone = $request->nuTelefone;
        $event->save();

        return back();
    }

    public function telconcreate($id)
    {
        $telefones = DB::table('contatos')->where('cdContato', '=', $id)->get();
        $events = Telefone_contato::all();
        $selecionado = Telefone_contato::join('contatos', 'contatos.cdContato', '=', 'telefone_contatos.cdContatoTelefone')
            ->where('cdContato', '=', $id)
            ->get();

        return view('telcon/telcon', [
            'telefones' => $telefones,
            'events' => $events,
            'selecionado' => $selecionado,
        ]);
    }

    public function editTel($id)
    {
        //$events=Instituicoe::find($id);
        $edit = Telefone_contato::join('contatos', 'contatos.cdContato', '=', 'telefone_contatos.cdContatoTelefone')
            ->where('cdTelefone', '=', $id)
            ->get();
        // $insta = Instituicoe::join('tipo_instancias', 'tipo_instancias.cdTipoInstancia', '=','instituicoes.cdTipoInstituicao')->get();
        $insta = Contato::orderBy('nmContato')
            ->get();
        return view('telcon.edit', ['selecionado' => $edit, 'lista' => $insta]);
    }

    public function updateTel(Request $request, $id)
    {
        $cd = $request->input('cdContatoTelefone');
        $name = $request->input('nuDDDTelefone');
        $nu = $request->input('nuTelefone');

        DB::update('update telefone_contatos set cdContatoTelefone = ?, nuDDDTelefone = ?, nuTelefone = ?
        where cdTelefone = ?', [$cd, $name, $nu, $id]);

        return redirect()->route('telcon', ['id' => $cd]);
    }

    public function deleteTel($id)
    {
        Telefone_contato::find($id)->delete();
        // $deleted = DB::delete('delete from telefone_contatos where cdTelefone = ?', [$id]);
        return back();
    }
}
