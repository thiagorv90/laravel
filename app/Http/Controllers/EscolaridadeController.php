<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Escolaridade;
use DB;

class EscolaridadeController extends Controller
{
    public function escolaridadeindex()
    {
        // lista de escolaridades
        $events = Escolaridade::all();
        //$events = DB::table('contatos')->gets();

        return view('escolaridade/escolaridade', ['escolaridade' => $events]);
    }

    public function escolaridadestore(Request $request)
    {
        //para salvar uma escolaridade
        $events = new Escolaridade;
        $events->dsEscolaridade = $request->dsEscolaridade;
        $events->save();

        return redirect('/escolaridade');
    }

    public function updateEsc(Request $request, $id)
    {
        // update da escolaridade
        $name = $request->input('dsEscolaridade');
        DB::update('update escolaridades set dsEscolaridade = ? where cdEscolaridade = ?', [$name, $id]);

        return redirect('/escolaridade')->with('msg', 'evento alterado com sucesso');
    }

    public function editEsc($id)
    {
        //select das escolaridades para
        $events = escolaridade::find($id);
        //$events = DB::table('contatos')->gets();

        return view('escolaridade.edit', ['escolaridade' => $events]);
    }

    public function search(Request $request)
    {
        // search das escolaridades
        $request->validate([
            'query' => 'required',
        ]);

        $query = $request->input('query');
        $events = DB::table('escolaridades')
            ->select('cdEscolaridade', 'dsEscolaridade')
            ->where('dsEscolaridade', 'like', "%$query%")
            ->get();

        return view('/escolaridade/search-results', compact('events'));
    }
}
