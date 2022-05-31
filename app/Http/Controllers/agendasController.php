<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use DB;
use App\Models\Representacoe;
use App\Exports\InstaciasExport;

class agendasController extends Controller
{


   public function agendastore(Request $request, $id)
   {

      $event = new Agenda;

      $event->cdRepresentacao = $request->cdRepresentacao;
      $event->dtAgenda = $request->dtAgenda;
      $event->hrAgenda = $request->hrAgenda;
      $event->dsAssunto = $request->dsAssunto;
      $event->stAgenda = $request->stAgenda;
      $event->dsLocal = $request->dsLocal;
      $event->dsPauta = $request->dsPauta;
      $event->dsResumo = $request->dsResumo;
      $event->stSuplente = $request->stSuplente;

      $event->save();

      return back();
   }
   public function agendacreate($id)
   {
      $selecionado = Agenda::join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
         ->join('representante_suplentes', 'representacoes.cdTitular', '=', 'representante_suplentes.cdRepSup')
         ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
         ->where('representacoes.cdRepresentacao', '=', $id)
         ->get();
      $agendas = DB::table('representacoes')->where('cdRepresentacao', '=', $id)->get();


      return view('/agendas.agendas', ['agendas' => $agendas, 'selecionado' => $selecionado]);
   }

   public function editAgen($id)
   {
      //$events=Instituicoe::find($id);
      $edit = agenda::join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
         ->where('cdAgenda', '=', $id)
         ->get();
      // $insta = Instituicoe::join('tipo_instancias', 'tipo_instancias.cdTipoInstancia', '=','instituicoes.cdTipoInstituicao')->get();
      $insta = Representacoe::orderBy('cdTitular')
         ->get();
      return view('agendas.edit', ['selecionado' => $edit, 'lista' => $insta]);
   }

   public function updateAgen(Request $request, $id)
   {

      $cd = $request->input('cdRepresentacao');
      $agenda = $request->input('dtAgenda');
      $hora = $request->input('hrAgenda');
      $assunto = $request->input('dsAssunto');
      $sta = $request->input('stAgenda');
      $local = $request->input('dsLocal');
      $pauta = $request->input('dsPauta');
      $resumo = $request->input('dsResumo');
      $suplente = $request->input('stSuplente');

      DB::update('update agendas set cdRepresentacao = ?, dtAgenda = ?, hrAgenda = ?, dsAssunto = ?, stAgenda = ?, dsLocal = ?, dsPauta = ?, dsResumo = ?, stSuplente = ?
     where cdAgenda = ?', [$cd, $agenda, $hora, $assunto, $sta, $local, $pauta, $resumo, $suplente, $id]);


      return redirect()->route('agendas', ['id' => $cd]);
   }
   public function deleteAgen($id)
   {

      agenda::find($id)->delete();
      // $deleted = DB::delete('delete from telefone_contatos where cdTelefone = ?', [$id]);
      return redirect('/agendas');
   }
}
