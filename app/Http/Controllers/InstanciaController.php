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
use App\Models\Instancia_anexo;
use App\Models\Representacoe;
use App\Models\Tema_representacoe;
use App\Models\Instituicoe;
use App\Models\Representante_suplente;
use App\Exports\InstanciasExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class InstanciaController extends Controller
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

        $event->tpPrioridade = $request->tpPrioridade;
        $event->dsAmeacas = $request->dsAmeacas;
        $event->dsOportunidades = $request->dsOportunidades;
        $event->dsObservacao = $request->dsObservacao;
        $event->dsAtoNormativo = $request->dsAtoNormativo;
        $event->boCaraterDaInstancia = $request->boCaraterDaInstancia;

        $event->save();
        if ($request->has('nmAnexo')) {

            for ($i = 0; $i < count($request->allFiles()['nmAnexo']); $i++) {


                $file = $request->allfiles()['nmAnexo'][$i];
                $name = $request->file()['nmAnexo'][$i]->getClientOriginalName();
                $anexo = new Instancia_anexo();


                $explode = $file->store('public/files');
                $certo = explode("s/", $explode);


                $anexo->nmAnexo = $certo[1];
                $anexo->nmOriginal = $name;
                $anexo->cdInstancia = $event->cdInstancia;

                $anexo->save();

            }
        }

        return back();
    }

    public function instanciafile(Request $request, $id)
    {


        for ($i = 0; $i < count($request->allFiles()['nmAnexo']); $i++) {


            $file = $request->allfiles()['nmAnexo'][$i];
            $name = $request->file()['nmAnexo'][$i]->getClientOriginalName();
            $anexo = new Instancia_anexo();


            $explode = $file->store('public/files');
            $certo = explode("s/", $explode);


            $anexo->nmAnexo = $certo[1];
            $anexo->nmOriginal = $name;
            $anexo->cdInstancia = $id;

            $anexo->save();


        }

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


    public function edit($cdInstancia)
    {
        $edit = Instancia::join('tema_representacoes', 'instancias.cdTema', '=', 'tema_representacoes.cdTema')
            ->join('instituicoes', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
            ->where('instancias.cdinstancia', '=', $cdInstancia)
            ->get();
        $tema = DB::table('tema_representacoes')->get();
        $lista = Instancia::orderBy('nmInstancia')
            ->get();

        $anexo = Instancia::join('instancia_anexos', 'instancia_anexos.cdInstancia', '=', 'instancias.cdInstancia')->where('instancias.cdInstancia', '=', $cdInstancia)->get();

        return view('instancias.edit', ['edit' => $edit, 'lista' => $lista, 'tema' => $tema, 'anexo' => $anexo]);
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
        $pri = $request->input('tpPrioridade');
        $ame = $request->input('dsAmeacas');
        $opor = $request->input('dsOportunidades');
        $manda = $request->input('dsMandato');
        $carater = $request->input('boCaraterDaInstancia');
        $ato = $request->input('dsAtoNormativo');


        DB::update('update instancias set cdInstituicao = ?, cdTema = ?, nmInstancia = ?, tpFederalDistrital = ?, tpPublicoPrivado = ?, dsMandato = ?,
            stAtivo = ?, dsObjetivo = ?, tpPrioridade = ?, dsAmeacas = ?, dsOportunidades = ?, dsObservacao=?, boCaraterDaInstancia=?,dsAtoNormativo=?
            where cdInstancia = ?', [$cd, $tema, $name, $fed, $pub, $mand, $ativo, $obj, $pri, $ame, $opor, $manda, $carater, $ato, $id]);

        return redirect()->route('instancias', ['id' => $cd]);
    }

    public function deleteInstnImg($id)
    {
        $file = Instancia_anexo::where('nmAnexo', $id);


        unlink(public_path() . "/storage/files/$id");


        Instancia_anexo::where('nmAnexo', $id)->delete();


        // $deleted = DB::delete('delete from telefone_contatos where cdTelefone = ?', [$id]);
        return back();
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

    function index()
    {
        return view('typeahead_autocomplete');
    }

    function action(request $request)
    {
        $data = $request->all();

        $query = $data['query'];

        $filter_data = Instancia::select('nmInstancia')
            ->where('nmInstancia', 'LIKE', '%' . $query . '%')->get();

        return response()->json($filter_data);

    }

    public function relatorioFiltrado(Request $request)
    {
        $dataInicio = $request->input('dataInicio');
        $dataFim = $request->input('dataFim');

        if ($dataFim === null) {
            $instancias = Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
                ->where('r.dtInicioVigencia', '>=', $dataInicio)
                ->get();

            return view('exportsView/instanciasPorVigencia/instanciaPorVigenciaFiltrada', ['instancias'=>$instancias,'dataInicio'=>$dataInicio,'dataFim'=>$dataFim]);
        } elseif ($dataInicio === null) {
            $instancias = Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
                ->where('r.dtFimVigencia', '<=', $dataFim)
                ->get();

            return view('exportsView/instanciasPorVigencia/instanciaPorVigenciaFiltrada', ['instancias'=>$instancias,'dataInicio'=>$dataInicio,'dataFim'=>$dataFim]);
        } elseif ($dataInicio === null && $dataFim === null) {
            $instancias = Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
                ->get();

            return view('exportsView/instanciasPorVigencia/instanciaPorVigenciaFiltrada', ['instancias'=>$instancias,'dataInicio'=>$dataInicio,'dataFim'=>$dataFim]);
        }

        $instancias = Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
            ->where('r.dtFimVigencia', '<=', $dataFim)
            ->where('r.dtInicioVigencia', '>=', $dataInicio)
            ->get();

        return view('exportsView/instanciasPorVigencia/instanciaPorVigenciaFiltrada', ['instancias'=>$instancias,'dataInicio'=>$dataInicio,'dataFim'=>$dataFim]);

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
            ->join('agendas as a', 'a.cdRepresentacao', '=', 'r.cdRepresentacao')
            ->get();

        return view('exportsView/instanciasPorData', ['instancias' => $instancias]);
    }

    public function instanciasPorIdExportView()
    {
        $instancias = Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
            ->join('representante_suplentes as rs', 'rs.cdRepSup', '=', 'r.cdSuplente')
            ->join('representante_suplentes as rt', 'rt.cdRepSup', '=', 'r.cdTitular')
            ->select(\Illuminate\Support\Facades\DB::raw('nmInstancia, tpPublicoPrivado, tpFederalDistrital, dsObjetivo,
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

        return view('exportsView/instanciasPorVigencia/instanciasPorVigencia', ['instancias' => $instancias]);
    }

    public function instanciasPorStatusExportView()
    {
        $instancias = Instancia::all();

        return view('exportsView/instanciasPorStatus', ['instancias' => $instancias]);
    }

    public function exportPorId()
    {
        return (new InstanciasPorIdExport)->download('instanciaId.xlsx');
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

    public function exportPorVigencia(Request $request)
    {
        $dataInicio = $request->input('dataInicio');
        $dataFim = $request->input('dataFim');
        
        return (new InstanciaPorVigenciaExport($dataInicio, $dataFim))->download('instanciaPorVigencia.xlsx');
    }

    public function exportPorData()
    {
        return (new InstanciaPorData)->download('instanciaPorData.xlsx');
    }
}
