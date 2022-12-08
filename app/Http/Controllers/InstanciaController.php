<?php

namespace App\Http\Controllers;

use App\Exports\ExpRelInstancias;
use App\Exports\ExpRelInstituicoesInstancias;
use App\Exports\ExpRelTipoInstancias;
use App\Exports\ExpReunioesMensais;
use App\Exports\InstanciaAtivaExport;
use App\Exports\InstanciaPorData;
use App\Exports\InstanciaPorPrioridadeExport;
use App\Exports\InstanciaPorTemaExport;
use App\Exports\InstanciaPorVigenciaExport;
use App\Exports\InstanciasPorIdExport;
use Illuminate\Http\Request;
use App\Models\Instancia;
use App\Models\Agenda_anexo;
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
    { //Criação de uma instancia
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
        $event->dsSite = $request->dsSite;


        $event->save();
        if ($request->has('nmAnexo')) {
//upload dos arquivos da instancia
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

        //upload dos documentos da instancias na tela de editar
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
        //select dos dados para a criação da instancia
        $bread = DB::table('instituicoes')->leftjoin('instancias', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')->where('instituicoes.cdInstituicao', '=', $id)->first();
        $instituicaos = DB::table('instituicoes')->where('instituicoes.cdInstituicao', '=', $id)->get();
        $temas = DB::table('tema_representacoes')->get();
        $insta = Instancia::join('tema_representacoes', 'instancias.cdTema', '=', 'tema_representacoes.cdTema')
            ->join('instituicoes', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
            
            ->where('instancias.cdInstituicao', '=', $id)->get(['instancias.cdInstancia', 'nmInstancia', 'nmTema',
                'instancias.cdInstituicao', 'instancias.stAtivo']);

        return view('instancias.instancias', ['instancias' => $insta, 'temas' => $temas, 'instituicaos' => $instituicaos, 'bread' => $bread]);
    }


    public function edit($cdInstancia)
    {
        //select dos dados para editar uma instancia
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
        //faz os updates na tabela de instancia
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
        $site = $request->input('dsSite');


        DB::update('update instancias set cdInstituicao = ?, cdTema = ?, nmInstancia = ?, tpFederalDistrital = ?, tpPublicoPrivado = ?, dsMandato = ?,
            stAtivo = ?, dsObjetivo = ?, tpPrioridade = ?, dsAmeacas = ?, dsOportunidades = ?, dsObservacao=?, boCaraterDaInstancia=?,dsAtoNormativo=?, dsSite=?
            where cdInstancia = ?', [$cd, $tema, $name, $fed, $pub, $mand, $ativo, $obj, $pri, $ame, $opor, $manda, $carater, $ato, $site, $id]);

        return redirect()->route('instancias', ['id' => $cd]);
    }

    public function deleteInsta($id)
    {   //deleta da tabela de representantes , ligado a instancia selecionada
        DB::table('representacao_representantes')
            ->join('representacoes', 'representacao_representantes.cdRepresentacao', '=', 'representacoes.cdRepresentacao')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('instancias.cdInstancia', '=', $id)->delete();
//deleta da tabela de anexos das agendas , ligado a instancia selecionada
        $links = Agenda_anexo::join('agendas', 'agendas.cdAgenda', '=', 'agenda_anexos.cdAgenda')
            ->join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('instancias.cdInstancia', $id)->get();
//deleta os arquivos da instancia
        foreach ($links as $link) {
            unlink(public_path() . "/storage/files/$link->nmAnexo");
        }
        //deleta da tabela de agendas , ligado a instancia selecionada
        Agenda_anexo::join('agendas', 'agendas.cdAgenda', '=', 'agenda_anexos.cdAgenda')
            ->join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('instancias.cdInstancia', $id)->delete();
        DB::table('agendas')->join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('instancias.cdInstancia', $id)->delete();
        //deleta os anexos da tabela de representações , ligado a instancia selecionada
        $anexoRepre = DB::table('representacoes_anexos')->join('representacoes', 'representacoes.cdRepresentacao', '=', 'representacoes_anexos.cdRepresentacao')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('instancias.cdInstancia', $id)->get();
        foreach ($anexoRepre as $anexo) {
            unlink(public_path() . "/storage/files/$anexo->nmAnexo");
        }
        //deleta da tabela de representações_anexo , ligado a instancia selecionada
        DB::table('representacoes_anexos')->join('representacoes', 'representacoes.cdRepresentacao', '=', 'representacoes_anexos.cdRepresentacao')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('instancias.cdInstancia', $id)->delete();
        //deleta da tabela de representações , ligado a instancia selecionada
        Representacoe::join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('instancias.cdInstancia', $id)->delete();
        //deleta da tabela de telefone_contatos , ligado a instancia selecionada
        DB::table('telefone_contatos')->join('contatos', 'telefone_contatos.cdContatoTelefone', '=', 'contatos.cdContato')
            ->join('instancias', 'instancias.cdInstancia', '=', 'contatos.cdInstancia')
            ->where('instancias.cdInstancia', $id)->delete();
        //deleta da tabela de contatos , ligado a instancia selecionada
        DB::table('contatos')->join('instancias', 'instancias.cdInstancia', '=', 'contatos.cdInstancia')
            ->where('instancias.cdInstancia', $id)->delete();
//deleta os anexos da instancia , ligado a instancia selecionada
        $file = Instancia_anexo::join('instancias', 'instancias.cdInstancia', '=', 'instancia_anexos.cdInstancia')
            ->where('instancias.cdInstancia', $id)->get();

        foreach ($file as $files) {
            unlink(public_path() . "/storage/files/$files->nmAnexo");
        }
        //deleta da tabela instancias , ligado a instancia selecionada
        Instancia_anexo::where('nmAnexo', $id)->delete();
        Instancia::where('cdInstancia', $id)->delete();
        // $deleted = DB::delete('delete from telefone_contatos where cdTelefone = ?', [$id]);
        return back();
    }

    public function deleteInstnImg($id)
    {
        //deleta os arquivos do banco e retira da pasta files
        $file = Instancia_anexo::where('nmAnexo', $id);


        unlink(public_path() . "/storage/files/$id");


        Instancia_anexo::where('nmAnexo', $id)->delete();


        // $deleted = DB::delete('delete from telefone_contatos where cdTelefone = ?', [$id]);
        return back();
    }

    public function search(Request $request, $id)
    {
        //Função de search
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

            return view('exportsView/instanciasPorVigencia/instanciaPorVigenciaFiltrada', ['instancias' => $instancias, 'dataInicio' => $dataInicio, 'dataFim' => $dataFim]);
        } elseif ($dataInicio === null) {
            $instancias = Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
                ->where('r.dtFimVigencia', '<=', $dataFim)
                ->get();

            return view('exportsView/instanciasPorVigencia/instanciaPorVigenciaFiltrada', ['instancias' => $instancias, 'dataInicio' => $dataInicio, 'dataFim' => $dataFim]);
        } elseif ($dataInicio === null && $dataFim === null) {
            $instancias = Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
                ->get();

            return view('exportsView/instanciasPorVigencia/instanciaPorVigenciaFiltrada', ['instancias' => $instancias, 'dataInicio' => $dataInicio, 'dataFim' => $dataFim]);
        }

        $instancias = Instancia::join('representacoes as r', 'r.cdInstancia', '=', 'instancias.cdInstancia')
            ->where('r.dtFimVigencia', '<=', $dataFim)
            ->where('r.dtInicioVigencia', '>=', $dataInicio)
            ->get();

        return view('exportsView/instanciasPorVigencia/instanciaPorVigenciaFiltrada', ['instancias' => $instancias, 'dataInicio' => $dataInicio, 'dataFim' => $dataFim]);

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

    public function delinfo($empid = 0)
    {


        $employee = Instancia::find($empid);


        $html = "";

        if (!empty($employee)) {

            $html = '
                   <div class="modal-body">
                       A exclusão é permanente. Deseja prosseguir? ' . $employee->nmInstancia . '
                   </div>
                   <div class="modal-footer">
                       <form action="/instancias/' . $employee->cdInstancia . '" method="POST">
                       ' . csrf_field() . '
                       ' . method_field('DELETE') . '

                           <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar
                           </button>
                           <button type="submit" class="btn btn-danger delete-btn ms-1"
                                   data-bs-toggle="tooltip"
                                   data-bs-title="Deletar">Excluir
                           </button>
                       </form>
                   </div>
               </div>
           </div>
       </div>';

        }

        $response['html'] = $html;


        return response()->json($response);

    }

    public function relInstanciasExportView()
    {
        $instancias = DB::table('instancias')
            ->join('instituicoes', 'instancias.cdInstituicao', '=', 'instituicoes.cdInstituicao')
            ->join('contatos', 'contatos.cdInstancia', '=', 'instancias.cdInstancia')
            ->join('representacoes', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
            ->join('representacao_representantes', 'representacoes.cdRepresentacao', '=', 'representacao_representantes.cdRepresentacao')
            ->join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->select(DB::raw('instituicoes.nmInstituicao, instancias.nmInstancia, contatos.nmContato, representante_suplentes.nmRepresentanteSuplente,
            representacao_representantes.dsDesiginacao, representacao_representantes.dsNomeacao, representacoes.dtInicioVigencia,
            representacoes.dtFimVigencia, instancias.stAtivo, instancias.dsOBjetivo'))
            ->get();

        return view('exportsView/relPorInstancia', ['instancias' => $instancias]);
    }

    public function expInsta()
    {
        return (new ExpRelInstancias)->download('expRelInstancias.xlsx');
    }

    public function relInstituicoesInstanciaExportView()
    {
        $instancias = DB::table('instituicoes')
            ->join('instancias','instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
            ->join('representacoes', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
            ->join('representacao_representantes', 'representacoes.cdRepresentacao', '=', 'representacao_representantes.cdRepresentacao')
            ->join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->select(DB::raw('instituicoes.nmInstituicao, instancias.nmInstancia, representante_suplentes.nmRepresentanteSuplente, instancias.stAtivo'))
            ->orderBy('instituicoes.nmInstituicao')
            ->get();

        return view('exportsView/relInstituicaoInstancia', ['instancias' => $instancias]);
    }

    public function expInstituicao()
    {
        return (new ExpRelInstituicoesInstancias())->download('expRelInstituicoesInstancias.xlsx');
    }

    public function relTipoInstanciaExportView()
    {
        $instancias = DB::table('instancias')
            ->join('representacoes', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
            ->join('representacao_representantes', 'representacoes.cdRepresentacao', '=', 'representacao_representantes.cdRepresentacao')
            ->join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->select(DB::raw('instancias.tpFederalDistrital, instancias.tpPublicoPrivado, instancias.nmInstancia,
            representante_suplentes.nmRepresentanteSuplente, instancias.stAtivo'))
            ->get();

        return view('exportsView/relTipoInstancia', ['instancias' => $instancias]);
    }

    public function expTipoInstancia()
    {
        return (new ExpRelTipoInstancias)->download('expRelInstituicoesInstancias.xlsx');
    }

    public function relInstanciaVigenciaExportView()
    {
        $instancias = DB::table('instancias')
            ->join('instituicoes', 'instancias.cdInstituicao', '=', 'instituicoes.cdInstituicao')
            ->join('representacoes', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
            ->join('representacao_representantes', 'representacoes.cdRepresentacao', '=', 'representacao_representantes.cdRepresentacao')
            ->join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->select(DB::raw('instituicoes.nmInstituicao, instancias.nmInstancia, representante_suplentes.nmRepresentanteSuplente, representacao_representantes.dsDesiginacao,
            representacao_representantes.dsNomeacao, representacoes.dtInicioVigencia, representacoes.dtFimVigencia, instancias.stAtivo'))
            ->get();

        return view('exportsView/relInstanciaVigencia', ['instancias' => $instancias]);
    }

    public function expInstanciaVigencia()
    {
        return (new ExpRelTipoInstancias)->download('expRelInstituicoesInstancias.xlsx');
    }

    public function relReunioesMensais()
    {
        $reunioes = DB::table('instancias')
            ->join('representacoes', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
            ->join('representacao_representantes', 'representacoes.cdRepresentacao', '=', 'representacao_representantes.cdRepresentacao')
            ->join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->join('agendas', 'agendas.cdRepresentacao', '=', 'representacoes.cdRepresentacao')
            ->select(DB::raw('instancias.nmInstancia, representante_suplentes.nmRepresentanteSuplente, agendas.dsPauta'))
            ->get();

        return view('exportsView/relReunioesMensais', ['reunioes' => $reunioes]);
    }

    public function expReunioesMensais()
    {
        return (new ExpReunioesMensais)->download('expReunioesMensais.xlsx');
    }
}
