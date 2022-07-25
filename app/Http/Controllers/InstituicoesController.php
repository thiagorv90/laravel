<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Instituicoe;
use DB;
use App\Models\Tipo_instancia;

class InstituicoesController extends Controller
{

      public function search(Request $request){

         $request ->validate([
            'query'=>'required',
        ]);
        
      $query = $request->input('query');
         $events =DB::table('instituicoes')
      ->select('nmInstituicao','cdInstituicao')
      ->where('nmInstituicao','like',"%$query%")
     
      ->get();
      
      
      return view('/instituicoes/search-results',compact('events'));
      }
      


   public function instituicoesstore(Request $request)
   {

      $events = new Instituicoe;

      $events->nmInstituicao = $request->nmInstituicao;
      $events->cdTipoInstituicao = $request->cdTipoInstituicao;

      $events->save();

      return redirect('/instituicoes');
   }
   public function instituicoescreate()
   {

      $instituicoes = DB::table('tipo_instancias')->get();
      $events = DB::table('instituicoes')->get();
      return view('instituicoes/instituicoes', compact('instituicoes', 'events'));
   }
   public function updateInst(Request $request, $id)
   {

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
