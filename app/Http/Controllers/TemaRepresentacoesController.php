<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tema_representacoe;
use DB;

class TemaRepresentacoesController extends Controller
{
    public function temarepindex()
    {
        $events = Tema_representacoe::all();

        return view('temarep/temarep', ['tema_representacoe' => $events]);
    }

    public function temarepstore(Request $request)
    {
        $event = new Tema_representacoe;
        $event->nmTema = $request->nmTema;
        $event->save();

        return redirect('/temarep');
    }

    public function updateTem(Request $request, $id)
    {
        $name = $request->input('nmTema');
        DB::update('update tema_representacoes set nmTema = ? where cdTema = ?', [$name, $id]);

        return redirect('/temarep')->with('msg', 'evento alterado com sucesso');
    }

    public function editTem($id)
    {
        $events = Tema_representacoe::find($id);
        //$events = DB::table('contatos')->gets();

        return view('temarep.edit', ['temarep' => $events]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required',
        ]);

        $query = $request->input('query');
        $events = DB::table('tema_representacoes')
            ->select('cdTema', 'nmTema')
            ->where('nmTema', 'like', "%$query%")
            ->get();


        return view('/temarep/search-results', compact('events'));
    }
}
