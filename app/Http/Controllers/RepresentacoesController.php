<?php

namespace App\Http\Controllers;

use App\Exports\RepresentacaoNumerosExport;
use Illuminate\Http\Request;
use App\Models\Representacoe;
use DB;
use App\Models\Representante_suplente;
use App\Models\instancia;

use App\Exports\RepresentacoesExport;
use Maatwebsite\Excel\Facades\Excel;

class RepresentacoesController extends Controller
{

    public function representacoesstore(Request $request)
     {

        $event = new Representacoe;

        $event->cdInstancia = $request->cdInstancia;
        $event->cdTitular = $request->cdTitular;
        $event->cdSuplente = $request->cdSuplente;
        $event->dtInicioVigencia = $request->dtInicioVigencia;
        $event->dtFimVigencia = $request->dtFimVigencia;
        $event->dsDesignacao = $request->dsDesignacao;
        $event->dsNomeacao = $request->dsNomeacao;
        $event->stAtivo = $request->stAtivo;

        $event->save();

        return back();
     }
   
    public function representacoescreate()
    {
        $email = auth()->user()->email;
        $representantes = DB::table('representante_suplentes')
            ->join('users', 'email', '=', 'dsEmail')
            ->join('representacoes', 'representacoes.cdTitular', '=', 'representante_suplentes.cdRepSup')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->join('agendas', 'agendas.cdrepresentacao', '=', 'representacoes.cdRepresentacao')
            ->where('dsEmail', 'like', "$email")
            ->get();

        $events = Representacoe::all();
        $instancias = DB::table('instancias')->get();


        return view('representacoes/representacoes', ['representantes' => $representantes, 'events' => $events, 'instancias' => $instancias]);
    }

    public function editRep($id)
    {
        //$events=Instituicoe::find($id);
        $edit = Representacoe::join('representante_suplentes', 'representacoes.cdTitular', '=', 'representante_suplentes.cdRepSup')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('cdRepresentacao', '=', $id)
            ->get();
        // $insta = Instituicoe::join('tipo_instancias', 'tipo_instancias.cdTipoInstancia', '=','instituicoes.cdTipoInstituicao')->get();
        $rep = representante_suplente::orderBy('cdRepSup')
            ->get();
        $insta = instancia::orderBy('nmInstancia')
            ->get();

        return view('representacoes.edit', ['selecionado' => $edit, 'lista' => $insta, 'rep' => $rep]);
    }

    public function updateRep(Request $request, $id)
    {

        $cd = $request->input('cdInstancia');
        $titular = $request->input('cdTitular');
        $suplente = $request->input('cdSuplente');
        $ini = $request->input('dtInicioVigencia');
        $fim = $request->input('dtFimVigencia');
        $desi = $request->input('dsDesignacao');
        $nomea = $request->input('dsNomeacao');
        $ativo = $request->input('stAtivo');


        DB::update('update representacoes set cdInstancia = ?, cdTitular = ?, cdSuplente = ?, dtInicioVigencia = ?, dtFimVigencia = ?, dsDesignacao = ?, dsNomeacao = ?, stAtivo = ?
      where cdRepresentacao = ?', [$cd, $titular, $suplente, $ini, $fim, $desi, $nomea, $ativo, $id]);

        return redirect()->route('repre', ['id' => $cd]);
    }

    public function instareprescreate($id)
    {

        $representantes = DB::table('representante_suplentes')->get();
        $events = Representacoe::all();
        $instancias = DB::table('instancias')->where('instancias.cdInstancia', '=', $id)->get();
        $selecionado = Representacoe::join('representante_suplentes', 'representacoes.cdTitular', '=', 'representante_suplentes.cdRepSup')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->join('instituicoes', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
            ->leftjoin('agendas', 'agendas.cdRepresentacao', '=', 'representacoes.cdRepresentacao')
            ->where('instancias.cdInstancia', '=', $id)
            ->get(['representacoes.cdRepresentacao', 'nmRepresentanteSuplente', 'dtInicioVigencia', 'cdTitular', 'representacoes.cdInstancia', 'nmInstancia']);


        return view('representacoes/repinsta', ['selecionado' => $selecionado, 'instancias' => $instancias, 'events' => $events, 'representantes' => $representantes]);
    }

    public function export()
    {
        return (new RepresentacoesExport)->download('representacoes.xlsx');
    }

    public function exportRepEmNumeros()
    {
        return (new RepresentacaoNumerosExport)->download('repEmNumeros.xlsx');
    }

    public function representacoesExportView()
    {
        $representacoes = Representacoe::join('instancias', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
            ->join('representante_suplentes', 'representante_suplentes.cdRepSup', '=', 'representacoes.cdTitular')
            ->get();

        return view('exportsView/representacoes', ['representacoes' => $representacoes]);
    }

    public function representacoesPorNumeroExportView()
    {
        $instancias = Instancia::join('tema_representacoes', 'tema_representacoes.cdTema', '=', 'instancias.cdTema')
            ->get();

        return view('exportsView/representacoesNumero', ['instancias' => $instancias]);
    }
}
