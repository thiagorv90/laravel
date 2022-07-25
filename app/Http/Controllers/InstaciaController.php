<?php

namespace App\Http\Controllers;

use App\Exports\InstanciaAtivaExport;
use App\Exports\InstanciaPorData;
use App\Exports\InstanciaPorPrioridadeExport;
use App\Exports\InstanciaPorTemaExport;
use App\Exports\InstanciaPorVigenciaExport;
use App\Exports\InstanciasPorIdExport;
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
            ->where('instancias.cdInstituicao', '=', $id)->get(['instancias.cdInstancia', 'nmInstancia', 'nmTema', 'nmRepresentanteSuplente', 'instancias.cdInstituicao', 'instancias.stAtivo']);

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

        $lista = Instancia::orderBy('nmInstancia')
            ->get();
        return view('instancias.edit', ['edit' => $edit, 'lista' => $lista]);
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

    public function search(Request $request, $id)
    {
        $request->validate([
            'query' => 'required',
        ]);

        $query = $request->input('query');
        $events = DB::table('instancias')
            ->select('nmInstancia', 'cdInstancia')
            ->where('nmInstancia', 'like', "%$query%")
            ->where('cdInstituicao', '=', $id)
            ->get();

        return view('/instancias/search-results', compact('events'));
    }

    public function instanciasExportView()
    {
        $instancias = Instancia::join('tema_representacoes', 'instancias.cdTema', '=', 'tema_representacoes.cdTema')
            ->join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
            ->join('representante_suplentes as rt', 'rt.cdRepSup', '=', 'r.cdTitular')
            ->get();

        return view('exportsView/instancias', ['instancias' => $instancias]);
    }

    public function instanciasDataExportView()
    {
        $instancias = Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
            ->join('representante_suplentes as rt', 'rt.cdRepSup', '=', 'r.cdTitular')
            ->join('agendas as a', 'a.cdAgenda', '=', 'r.cdRepresentacao')
            ->get();

        return view('exportsView/instanciasPorData', ['instancias' => $instancias]);
    }

    public function instanciasPorIdExportView()
    {
        $instancias = Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
            ->join('representante_suplentes as rs', 'rs.cdRepSup', '=', 'r.cdSuplente')
            ->join('representante_suplentes as rt', 'rt.cdRepSup', '=', 'r.cdTitular')
            ->select(\Illuminate\Support\Facades\DB::raw('nmInstancia, tpAtribuicoes, tpPublicoPrivado, tpFederalDistrital, dsObjetivo,
                rs.nmRepresentanteSuplente as repSup, rt.nmRepresentanteSuplente as repTit'))
            ->get();

        return view('exportsView/instanciasPorId', ['instancias' => $instancias]);
    }

    public function instanciasPorPrioridadeExportView()
    {
        $instancias = Instancia::all();

        return view('exportsView/instanciasPorPrioridade', ['instancias' => $instancias]);
    }

    public function instanciasPorTemaView()
    {
        $instancias = Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
            ->join('representante_suplentes as rs', 'rs.cdRepSup', '=', 'r.cdSuplente')
            ->join('representante_suplentes as rt', 'rt.cdRepSup', '=', 'r.cdTitular')
            ->join('tema_representacoes as tr', 'instancias.cdTema', '=', 'tr.cdTema')
            ->select(\Illuminate\Support\Facades\DB::raw('tr.nmTema as tema, instancias.nmInstancia as instancia,
                rt.nmRepresentanteSuplente as repTit, rs.nmRepresentanteSuplente as repSup'))
            ->get();

        return view('exportsView/instanciasPorTema', ['instancias' => $instancias]);
    }

    public function instanciasPorVigenciaView()
    {
        $instancias = Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
            ->get();

        return view('exportsView/instanciasPorVigencia', ['instancias' => $instancias]);
    }

    public function instanciasPorStatusExportView()
    {
        $instancias = Instancia::all();

        return view('exportsView/instanciasPorStatus', ['instancias' => $instancias]);
    }

    public function export()
    {
        return (new InstanciasExport)->download('instancias.xlsx');
    }

    public function exportPorId()
    {
        return (new InstanciasPorIdExport())->download('instanciaId.xlsx');
    }

    public function exportPorStatus()
    {
        return (new InstanciaAtivaExport)->download('instanciaStatus.xlsx');
    }

    public function exportPorTema()
    {
        return (new InstanciaPorTemaExport)->download('instanciaTema.xlsx');
    }

    public function exportPorPrioridade()
    {
        return (new InstanciaPorPrioridadeExport)->download('instanciaPrioridade.xlsx');
    }

    public function exportPorVigencia()
    {
        return (new InstanciaPorVigenciaExport)->download('instanciaPorVigencia.xlsx');
    }

    public function exportPorData()
    {
        return (new InstanciaPorData)->download('instanciaPorData.xlsx');
    }
}
