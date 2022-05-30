<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instancia;
use App\Models\Representacoe;
use App\Models\Tema_representacoe;
use App\Models\Instituicoe;
use App\Models\Representante_suplente;
use App\Exports\InstanciasExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class InstaciaController extends Controller
{
  public function storeinst(Request $request, $id)
  {

    $event = new Instancia;

    $event->cdInstituicao = $request->cdInstituicao;
    $event->cdTema = $request->cdTema;
    $event->nmInstancia = $request->nmInstancia;
    $event->tpFederalDistrital = $request->tpFederalDistrital;
    $event->tpPublicoPrivado = $request->tpPublicoPrivado;
    $event->dsMandato = $request->dsMandato;
    $event->stAtivo = $request->stAtivo;
    $event->dsObjetivo = $request->dsObjetivo;
    $event->tpAtribuicoes = $request->tpAtribuicoes;
    $event->tpPrioridade = $request->tpPrioridade;
    $event->dsAmeacas = $request->dsAmeacas;
    $event->dsOportunidades = $request->dsOportunidades;
    $event->dsObservacao = $request->dsObservacao;


    $event->save();

    return back();
  }


  public function instacreate($id)
  {


    $instituicaos = DB::table('instituicoes')->where('instituicoes.cdInstituicao', '=', $id)->get();
    $temas = DB::table('tema_representacoes')->get();
    $insta = Instancia::join('tema_representacoes', 'instancias.cdTema', '=', 'tema_representacoes.cdTema')
      ->join('instituicoes', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
      ->leftjoin('representacoes', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
      ->leftjoin('representante_suplentes', 'representacoes.cdTitular', '=', 'cdRepsup')
      ->leftjoin('contatos', 'contatos.cdInstancia', '=', 'instancias.cdInstancia')
      ->where('instancias.cdInstituicao', '=', $id)->get(['instancias.cdInstancia', 'nmInstancia', 'nmTema', 'nmRepresentanteSuplente', 'nmContato']);


    return view('instancias.instancias', ['instancias' => $insta, 'temas' => $temas, 'instituicaos' => $instituicaos]);
  }

  public function dash()
  {


    $insta = Instancia::join('tema_representacoes', 'instancias.cdTema', '=', 'tema_representacoes.cdTema')
      ->join('instituicoes', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
      ->join('representacoes', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
      ->join('representante_suplentes', 'representante_suplentes.cdRepSup', '=', 'representacoes.cdTitular')->get();

    return view('inicial', ['instancias' => $insta]);
  }

  public function show($cdInstancia)
  {

    $insta = Instancia::join('tema_representacoes', 'instancias.cdTema', '=', 'tema_representacoes.cdTema')
      ->join('instituicoes', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
      ->join('representacoes', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
      ->join('representante_suplentes', 'representante_suplentes.cdRepSup', '=', 'representacoes.cdTitular')
      ->where('instancias.cdinstancia', '=', $cdInstancia)
      ->get([
        'instancias.nmInstancia', 'tema_representacoes.nmTema', 'instituicoes.nmInstituicao', 'representante_suplentes.dsemail', 'representante_suplentes.nmRepresentanteSuplente',
        'instancias.tpFederalDistrital', 'instancias.tpPublicoPrivado', 'instancias.dsMandato', 'instancias.stAtivo', 'instancias.dsObjetivo', 'instancias.tpAtribuicoes',
        'instancias.tpPrioridade', 'instancias.dsAmeacas', 'instancias.dsOportunidades', 'instancias.dsObservacao'
      ]);

    return view('instancias.show', ['insta' => $insta]);
  }
  public function edit($cdInstancia)
  {
    $edit = Instancia::join('tema_representacoes', 'instancias.cdTema', '=', 'tema_representacoes.cdTema')
      ->join('instituicoes', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
      ->where('instancias.cdinstancia', '=', $cdInstancia)
      ->get();


    return view('instancias.edit', ['edit' => $edit]);
  }

  public function update(Request $request, $id)
  {

    $cd = $request->input('cdInstituicao');
    $tema = $request->input('cdTema');
    $name = $request->input('nmInstancia');
    $fed = $request->input('tpFederalDistrital');
    $pub = $request->input('tpPublicoPrivado');
    $mand = $request->input('dsMandato');
    $ativo = $request->input('stAtivo');
    $obj = $request->input('dsObjetivo');
    $atr = $request->input('tpAtribuicoes');
    $pri = $request->input('tpPrioridade');
    $ame = $request->input('dsAmeacas');
    $opor = $request->input('dsOportunidades');
    $manda = $request->input('dsMandato');


    DB::update('update instancias set cdInstituicao = ?, cdTema = ?, nmInstancia = ?, tpFederalDistrital = ?, tpPublicoPrivado = ?, dsMandato = ?,
            stAtivo = ?, dsObjetivo = ?, tpAtribuicoes = ?, tpPrioridade = ?, dsAmeacas = ?, dsOportunidades = ?, dsObservacao=?
            where cdInstancia = ?', [$cd, $tema, $name, $fed, $pub, $mand, $ativo, $obj, $atr, $pri, $ame, $opor, $manda, $id]);

    return redirect()->route('instancias', ['id' => $cd]);
  }

  public function export()
  {
    return (new InstanciasExport)->download('instancias.xlsx');
  }
}
