<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Agenda_anexo;
use DB;
use App\Models\Representacoe;
use App\Exports\InstaciasExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AgendaExport;
use App\Exports\AgendaFiltradaExport;

class AgendasController extends Controller
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

        if ($request->has('nmAnexo')) {

            for ($i = 0; $i < count($request->allFiles()['nmAnexo']); $i++) {


                $file = $request->allfiles()['nmAnexo'][$i];
                $name = $request->file()['nmAnexo'][$i]->getClientOriginalName();
                $anexo = new Agenda_anexo();


                $explode = $file->store('public/files');
                $certo = explode("s/", $explode);


                $anexo->nmAnexo = $certo[1];
                $anexo->nmOriginal = $name;
                $anexo->cdAgenda = $event->cdAgenda;

                $anexo->save();

            }

        }


        return back();
    }

    public function agendafile(Request $request, $id)
    {


        for ($i = 0; $i < count($request->allFiles()['nmAnexo']); $i++) {


            $file = $request->allfiles()['nmAnexo'][$i];
            $name = $request->file()['nmAnexo'][$i]->getClientOriginalName();
            $anexo = new Agenda_anexo();


            $explode = $file->store('public/files');
            $certo = explode("s/", $explode);


            $anexo->nmAnexo = $certo[1];
            $anexo->nmOriginal = $name;
            $anexo->cdAgenda = $id;

            $anexo->save();

        }
        return back();
    }

    public function dashboard()
    {
       

        $selecionado = Agenda::join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
            ->join('representante_suplentes', 'representacoes.cdTitular', '=', 'representante_suplentes.cdRepSup')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')->whereBetween('dtAgenda',
                [Carbon::now('America/Sao_Paulo')->startOfWeek(), Carbon::now('America/Sao_Paulo')->endOfWeek()]
            )
            ->get();
        $mes = Agenda::join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
            ->join('representante_suplentes', 'representacoes.cdTitular', '=', 'representante_suplentes.cdRepSup')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')->whereBetween('dtAgenda',
                [Carbon::now('America/Sao_Paulo')->startOfMonth(), Carbon::now('America/Sao_Paulo')->endOfMonth()]
            )
            ->get();


        return view('/dashboard', ['selecionado'=>$selecionado,'mes'=>$mes]);
    }

    public function agendacreate($id)
    {
        $selecionado = Agenda::join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
            ->join('representante_suplentes', 'representacoes.cdTitular', '=', 'representante_suplentes.cdRepSup')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('representacoes.cdRepresentacao', '=', $id)
            ->get(['cdAgenda', 'agendas.cdRepresentacao', 'dtAgenda', 'hrAgenda', 'agendas.stAgenda', 'dsAssunto',
                'dsLocal', 'dsPauta', 'dsResumo', 'stSuplente', 'nmRepresentanteSuplente', 'nmInstancia', 'representacoes.cdInstancia']);
        $agendas = DB::table('representacoes')->where('cdRepresentacao', '=', $id)->get();
        $repes = DB::table('representante_suplentes')->join('representacoes', 'representacoes.cdTitular', '=', 'representante_suplentes.cdRepSup')->where('cdRepresentacao', '=', $id)->get();


        return view('/agendas.agendas', ['agendas' => $agendas, 'selecionado' => $selecionado, 'repes' => $repes]);
    }

    public function editAgen($id)
    {
        //$events=Instituicoe::find($id);
        $edit = agenda::join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
            ->join('representante_suplentes', 'representacoes.cdTitular', '=', 'representante_suplentes.cdRepSup')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('cdAgenda', '=', $id)
            ->get();
        // $insta = Instituicoe::join('tipo_instancias', 'tipo_instancias.cdTipoInstancia', '=','instituicoes.cdTipoInstituicao')->get();

        $insta = Representacoe::orderBy('cdTitular')
            ->get();
        $anexo = Agenda::join('agenda_anexos', 'agenda_anexos.cdAgenda', '=', 'agendas.cdAgenda')->where('agendas.cdAgenda', '=', $id)->get();
        $anexoImg = Agenda::join('agenda_anexos', 'agenda_anexos.cdAgenda', '=', 'agendas.cdAgenda')->where('agendas.cdAgenda', '=', $id)->get(['agenda_anexos.cdAgenda']);
        return view('agendas.edit', ['selecionado' => $edit, 'lista' => $insta, 'anexo' => $anexo, 'anexoImg' => $anexoImg]);
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

    public function downloadAgen(Request $request, $id)
    {

        //return response()->download('prjsgr1/storage/app/files/'.$id);

        $file = public_path() . "/storage/files/$id";


        return \Response::download($file);
    }

    public function deleteAgenImg($id)
    {
        $file = Agenda_anexo::where('nmAnexo', $id);


        unlink(public_path() . "/storage/files/$id");


        Agenda_anexo::where('nmAnexo', $id)->delete();


        // $deleted = DB::delete('delete from telefone_contatos where cdTelefone = ?', [$id]);
        return back();
    }


    public function deleteAgen($id)
    {
        $links = Agenda_anexo::where('cdAgenda', $id)->get();

        foreach ($links as $link) {
            unlink(public_path() . "/storage/files/$link->nmAnexo");
        }
        Agenda_anexo::where('cdAgenda', $id)->delete();
        Agenda::find($id)->delete();
        // $deleted = DB::delete('delete from telefone_contatos where cdTelefone = ?', [$id]);
        return back();
    }

    public function search(Request $request, $id)
    {
        $request->validate([
            'query' => 'required', 'busca' => 'required',
        ]);

        $query = $request->input('query');
        $busca = $request->input('busca');

        if ($busca == 1) {
            $events = DB::table('agendas')
                ->where('dsAssunto', 'like', "%$query%")
                ->where('cdAgenda', '=', $id)
                ->get();
        }

        if ($busca == 2) {
            $events = DB::table('agendas')
                ->where('dsPauta', 'like', "%$query%")
                ->where('cdAgenda', '=', $id)
                ->get();
        }

        return view('/agendas/search-results', compact('events'));
    }
    public function export(Request $request)
    {
        
        return (new AgendaExport)->download('agendas.xlsx');
    }
    public function exportfiltrada(Request $request)
    {
        $dataInicio = $request->input('dataInicio');
        $dataFim = $request->input('dataFim');
        
        return (new AgendaFiltradaExport($dataInicio, $dataFim))->download('agendas.xlsx');
    }
    public function exportViewAgendas ()
    {
        $agendas = Agenda::join('representacoes', 'agendas.cdRepresentacao', '=', 'representacoes.cdRepresentacao')
        ->join('instancias', 'instancias.cdInstancia', '=','representacoes.cdInstancia')
        ->join('instituicoes','instituicoes.cdInstituicao','instancias.cdInstituicao')
        ->join('representante_suplentes', 'representacoes.cdTitular', '=', 'representante_suplentes.cdRepSup')
            ->get();

        return view('exportsView/agendas', ['agendas' => $agendas]);
    }

    public function relatorioFiltrado(Request $request)
    {
        $dataInicio = $request->input('dataInicio');
        $dataFim = $request->input('dataFim');

       
        $agendas = Agenda::join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
        ->join('representante_suplentes', 'representacoes.cdTitular', '=', 'representante_suplentes.cdRepSup')
        
        ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
        ->join('instituicoes','instituicoes.cdInstituicao','instancias.cdInstituicao')->whereBetween('dtAgenda',[$dataInicio,  $dataFim]         
        )
        ->get();
        
        
            return view('exportsView/agendaFiltrada', ['agendas'=> $agendas,'dataInicio'=>$dataInicio,'dataFim'=>$dataFim]);
        }



}
