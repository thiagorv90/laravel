<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Instituicoe;
use DB;
use App\Models\Tipo_instancia;
use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class InstituicoesController extends Controller
{
    //função de search da instituição
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required',
        ]);

        $query = $request->input('query');
        $events = DB::table('instituicoes')
            ->select('nmInstituicao', 'cdInstituicao')
            ->where('nmInstituicao', 'like', "%$query%")
            ->get();

        return view('/instituicoes/search-results', compact('events'));
    }

    public function insta(Request $request)
    {//search das instancias na instituição
        $request->validate([
            'query' => 'required',
        ]);

        $query = $request->input('query');
        $events = DB::table('instancias')
            ->select('nmInstancia', 'cdInstancia')
            ->where('nmInstancia', 'like', "%$query%")
            ->get();

        return view('/instancias/search-results', compact('events'));
    }

    public function instituicoesstore(Request $request)
    {// Salva as Instituções  
        $events = new Instituicoe;
        $events->nmInstituicao = $request->nmInstituicao;
        $events->cdTipoInstituicao = $request->cdTipoInstituicao;
        $events->save();

        return redirect('/instituicoes');
    }

    public function instituicoescreate()
    {//select para criação de instituições
        $instituicoes = DB::table('tipo_instancias')->get();
        $events = DB::table('instituicoes')->join('tipo_instancias', 'tipo_instancias.cdTipoInstancia', '=', 'instituicoes.cdTipoInstituicao')->orderby('nmInstituicao')->simplepaginate(10);
        return view('instituicoes/instituicoes', compact('instituicoes', 'events'));
    }

    public function updateInst(Request $request, $id)
    {//updante na instituições 
        $cd = $request->input('cdTipoInstituicao');
        $name = $request->input('nmInstituicao');

        DB::update('update instituicoes set cdTipoInstituicao = ?, nmInstituicao = ?  where cdInstituicao = ?', [$cd, $name, $id]);

        return redirect('/instituicoes')->with('msg', 'evento alterado com sucesso');
    }

    public function editInst($id)
    {
        //$events=Instituicoe::find($id);
        $edit = Instituicoe::join('tipo_instancias', 'tipo_instancias.cdTipoInstancia', '=', 'instituicoes.cdTipoInstituicao')
            ->where('Instituicoes.cdInstituicao', '=', $id)
            ->get();
        // $insta = Instituicoe::join('tipo_instancias', 'tipo_instancias.cdTipoInstancia', '=','instituicoes.cdTipoInstituicao')->get();
        $insta = Tipo_instancia::orderBy('dsTipoInstancia')
            ->get();
        return view('instituicoes.edit', ['selecionado' => $edit, 'lista' => $insta]);
    }
}
