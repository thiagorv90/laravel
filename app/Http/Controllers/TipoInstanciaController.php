<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo_instancia;
use DB;

class TipoInstanciaController extends Controller
{
   public function tipoinstaindex()
   {

      $events = Tipo_instancia::all();


      return view('tipoinsta/tipoinsta', ['tipo_instancia' => $events]);
   }

   public function tipoinstastore(Request $request)
   {

      $event = new Tipo_instancia;

      $event->dsTipoInstancia = $request->dsTipoInstancia;



      $event->save();

      return redirect('/tipoinsta');
   }

   public function updateTipo(Request $request, $id)
   {
      $name = $request->input('dsTipoInstancia');
      DB::update('update tipo_instancias set dsTipoInstancia = ? where cdTipoInstancia = ?', [$name, $id]);


      return redirect('/tipoinsta')->with('msg', 'evento alterado com sucesso');
   }

   public function editTipo($id)
   {
      $events = Tipo_instancia::find($id);
      //$events = DB::table('contatos')->gets();

      return view('tipoinsta.edit', ['tipoinsta' => $events]);
   }
}
