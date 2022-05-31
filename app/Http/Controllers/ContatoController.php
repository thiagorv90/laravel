<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;
use DB;
use App\Models\Instancia;

class ContatoController extends Controller
{


   public function contastore(Request $request, $id)
   {

      $events = new Contato;

      $events->cdInstancia = $request->cdInstancia;
      $events->tpContatoRepresentante = $request->tpContatoRepresentante;
      $events->nmContato = $request->nmContato;
      $events->dsEmail = $request->dsEmail;
      $events->dsEmailAlternativo = $request->dsEmailAlternativo;
      $events->stAtivo = $request->stAtivo;

      $events->save();

      return back();
   }
   public function contacreate()
   {

      $contatos = DB::table('instancias')->get();
      $events = Contato::all();


      return view('contatos\contatos', compact('contatos', 'events'));
   }

   public function contalista($id)
   {
      $contatos = DB::table('instancias')->where('instancias.cdInstancia', '=', $id)->get();
      $edit = contato::join('instancias', 'contatos.cdInstancia', '=', 'instancias.cdInstancia')
         ->where('instancias.cdInstancia', '=', $id)
         ->get();

      return view('contatos.listacontato', ['selecionado' => $edit, 'contatos' => $contatos]);
   }
   public function editCon($id)
   {
      //$events=Instituicoe::find($id);
      $edit = contato::join('instancias', 'contatos.cdInstancia', '=', 'instancias.cdInstancia')
         ->where('cdContato', '=', $id)
         ->get();
      // $insta = Instituicoe::join('tipo_instancias', 'tipo_instancias.cdTipoInstancia', '=','instituicoes.cdTipoInstituicao')->get();
      $insta = Instancia::orderBy('nmInstancia')
         ->get();

      return view('contatos.edit', ['selecionado' => $edit, 'lista' => $insta]);
   }

   public function updateCon(Request $request, $id)
   {

      $cd = $request->input('cdInstancia');
      $con = $request->input('tpContatoRepresentante');
      $name = $request->input('nmContato');
      $email = $request->input('dsEmail');
      $emaila = $request->input('dsEmailAlternativo');
      $ativo = $request->input('stAtivo');

      DB::update('update contatos set cdInstancia = ?, tpContatoRepresentante = ?, nmContato = ?, dsEmail = ?, dsEmailAlternativo = ?, stAtivo = ? 
     where cdContato = ?', [$cd, $con, $name, $email, $emaila, $ativo, $id]);


      return redirect()->route('contatos', ['id' => $cd]);
   }


   public function search(Request $request)
   {
      $request->validate([
         'query' => 'required',
      ]);

      $query = $request->input('query');

      $events = contato::where('nmContato', 'like', "%$query%")->orWhere('dsEmail', 'like', "%$query%")->get();

      return view('/contatos/search-results', compact('events'));
   }
}
