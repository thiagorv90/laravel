<?php

namespace App\Http\Controllers;

use App\Exports\ExpRepresentacaoEmNumeros;
use App\Exports\ExpRepresentantes;
use App\Exports\RepresentacaoNumerosExport;
use Illuminate\Http\Request;
use App\Models\Representacoe;
use App\Models\Representacoes_anexo;
use App\Models\Agenda_anexo;
use App\Models\Vw_representacoe;
use DB;
use App\Models\Representante_suplente;
use App\Models\Representacao_representante;
use App\Models\Instancia;
use Illuminate\Support\Facades\Storage;
use App\Exports\RepresentacoesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Auth\Access\Response;
use Carbon\Carbon;

class RepresentacoesController extends Controller
{

    public function representacoesstore(Request $request)
    {
        $event = new Representacoe;
        $event->cdInstancia = $request->cdInstancia;
        $event->dsObservacao = $request->dsObservacao;
        $event->dtInicioVigencia = $request->dtInicioVigencia;
        $event->dtFimVigencia = $request->dtFimVigencia;

        $event->stAtivo = $request->stAtivo;


        $event->save();
        if ($request->has('nmAnexo')) {

            for ($i = 0; $i < count($request->allFiles()['nmAnexo']); $i++) {


                $file = $request->allfiles()['nmAnexo'][$i];
                $name = $request->file()['nmAnexo'][$i]->getClientOriginalName();
                $anexo = new Representacoes_anexo();


                $explode = $file->store('public/files');
                $certo = explode("s/", $explode);


                $anexo->nmAnexo = $certo[1];
                $anexo->nmOriginal = $name;
                $anexo->cdRepresentacao = $event->cdRepresentacao;

                $anexo->save();

            }

        }

        $teste = '1';
        $representantes = Representante_suplente::orderby('nmRepresentanteSuplente')->get(['cdRepSup', 'nmRepresentanteSuplente']);
        return view('representacoes/representantes', ['event' => $event, 'representantes' => $representantes, 'teste' => $teste]);
    }

    public function delrepresentacoes($id)
    {
        DB::table('representacao_representantes')
            ->join('representacoes', 'representacao_representantes.cdRepresentacao', '=', 'representacoes.cdRepresentacao')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('representacoes.cdRepresentacao', '=', $id)->delete();

        $links = Agenda_anexo::join('agendas', 'agendas.cdAgenda', '=', 'agenda_anexos.cdAgenda')
            ->join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('representacoes.cdRepresentacao', $id)->get();

        foreach ($links as $link) {
            unlink(public_path() . "/storage/files/$link->nmAnexo");
        }
        Agenda_anexo::join('agendas', 'agendas.cdAgenda', '=', 'agenda_anexos.cdAgenda')
            ->join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('representacoes.cdRepresentacao', $id)->delete();
        DB::table('agendas')->join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('representacoes.cdRepresentacao', $id)->delete();

        $anexoRepre = DB::table('representacoes_anexos')->join('representacoes', 'representacoes.cdRepresentacao', '=', 'representacoes_anexos.cdRepresentacao')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('representacoes.cdRepresentacao', $id)->get();
        foreach ($anexoRepre as $anexo) {
            unlink(public_path() . "/storage/files/$anexo->nmAnexo");
        }
        DB::table('representacoes_anexos')->join('representacoes', 'representacoes.cdRepresentacao', '=', 'representacoes_anexos.cdRepresentacao')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('representacoes.cdRepresentacao', $id)->delete();

        Representacoe::join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('representacoes.cdRepresentacao', $id)->delete();


        // $deleted = DB::delete('delete from telefone_contatos where cdTelefone = ?', [$id]);
        return back();
    }


    public function createrep(Request $request, $id)
    {

        $idcontracts = array();
        $teste = '0';
        $event = new Representacao_representante;
        $event->cdRepSup = $request->cdRepSup;
        $event->dtInicioNomeacao = $request->dtInicioNomeacao;
        $event->stRepresentante = '1';
        $event->dsDesiginacao = $request->dsDesiginacao;
        $event->dsNomeacao = $request->dsNomeacao;
        $event->cdRepresentacao = $request->cdRepresentacao;
        $event->stTitularidade = $request->stTitularidade;
        $event->save();

        $bread = DB::table('instituicoes')->leftjoin('instancias', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
            ->join('representacoes', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->join('representacao_representantes', 'representacao_representantes.cdRepresentacao', '=', 'representacoes.cdRepresentacao')
            ->where('representacao_representantes.cdRepresentacao', '=', $event->cdRepresentacao)->first(['instancias.cdInstancia', 'nmInstituicao', 'nmInstancia', 'instancias.cdInstituicao']);

        $incluidos = Representacao_representante::join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->join('representacoes', 'representacao_representantes.cdRepresentacao', '=', 'representacoes.cdRepresentacao')
            ->where('representacao_representantes.cdRepresentacao', '=', $event->cdRepresentacao)->get(['nmRepresentanteSuplente', 'stRepresentante', 'representante_suplentes.cdRepSup', 'stTitularidade', 'representacoes.cdInstancia']);

        $cdRepSUp = Representacao_representante::join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->where('representacao_representantes.cdRepresentacao', '=', $event->cdRepresentacao)->get(['representante_suplentes.cdRepSup']);
        foreach ($cdRepSUp as $key) {
            if (!in_array($key->cdRepSup, $idcontracts)) {
                array_push($idcontracts, $key->cdRepSup);
            }
        }


        $representantes = DB::table('representante_suplentes')->whereNotIn('cdRepSup', $idcontracts)->orderby('nmRepresentanteSuplente')->get();

        return view('representacoes/representantes', ['event' => $event, 'representantes' => $representantes, 'incluidos' => $incluidos, 'teste' => $teste, 'bread' => $bread]);
    }

    public function deleterep(Request $request, $id)
    {
        $event = Representacoe::join('representacao_representantes', 'representacao_representantes.cdRepresentacao', '=', 'representacoes.cdRepresentacao')
            ->where('representacao_representantes.cdRepSup', '=', $id)->first();
        $bread = DB::table('instituicoes')->leftjoin('instancias', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
            ->leftjoin('representacoes', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->join('representacao_representantes', 'representacao_representantes.cdRepresentacao', '=', 'representacoes.cdRepresentacao')
            ->where('representacao_representantes.cdRepSup', '=', $id)->first(['nmInstituicao', 'nmInstancia', 'instancias.cdInstituicao', 'instancias.cdInstancia']);

        $idcontracts = array();
        $teste = '0';
        Representacao_representante::where('cdRepSup', $id)->delete();


        $incluidos = Representacao_representante::join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->join('representacoes', 'representacao_representantes.cdRepresentacao', '=', 'representacoes.cdRepresentacao')
            ->where('representacao_representantes.cdRepresentacao', '=', $event->cdRepresentacao)->get(['nmRepresentanteSuplente', 'stRepresentante', 'representante_suplentes.cdRepSup', 'stTitularidade', 'representacoes.cdInstancia']);

        $cdRepSUp = Representacao_representante::join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->where('representacao_representantes.cdRepresentacao', '=', $event->cdRepresentacao)->get(['representante_suplentes.cdRepSup']);
        foreach ($cdRepSUp as $key) {
            if (!in_array($key->cdRepSup, $idcontracts)) {
                array_push($idcontracts, $key->cdRepSup);
            }
        }


        $representantes = DB::table('representante_suplentes')->whereNotIn('cdRepSup', $idcontracts)->orderby('nmRepresentanteSuplente')->get();

        return view('representacoes/representantes', ['representantes' => $representantes, 'incluidos' => $incluidos, 'teste' => $teste, 'event' => $event, 'bread' => $bread]);
    }


    public function representacoesfile(Request $request, $id)
    {
        for ($i = 0; $i < count($request->allFiles()['nmAnexo']); $i++) {

            $file = $request->allfiles()['nmAnexo'][$i];
            $name = $request->file()['nmAnexo'][$i]->getClientOriginalName();
            $anexo = new Representacoes_anexo();

            $explode = $file->store('public/files');
            $certo = explode("s/", $explode);

            $anexo->nmAnexo = $certo[1];
            $anexo->nmOriginal = $name;
            $anexo->cdRepresentacao = $id;

            $anexo->save();
        }
        return back();
    }


    public function deleteRepreImg($id)
    {
        $file = Representacoes_anexo::where('nmAnexo', $id);

        unlink(public_path() . "/storage/files/$id");

        Representacoes_anexo::where('nmAnexo', $id)->delete();

        // $deleted = DB::delete('delete from telefone_contatos where cdTelefone = ?', [$id]);
        return back();
    }


    public function representacoescreate()
    {
        $email = auth()->user()->email;

        $representantes = DB::table('agendas')
            ->join('representacoes', 'representacoes.cdRepresentacao', '=', 'agendas.cdRepresentacao')
            ->join('representacao_representantes', 'representacao_representantes.cdRepresentacao', '=', 'representacoes.cdRepresentacao')
            ->join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->leftjoin('representante_suplentes as s', 'representacoes.cdSuplente', '=', 's.cdRepSup')
            ->where('dsEmail', 'like', "$email")->orwhere('representante_suplentes.dsEmail as emailrepre', 'Like', "$email")->get();


        $events = Representacoe::all();
        $instancias = DB::table('instancias')->get();

        return view('representacoes/representacoes', ['representantes' => $representantes, 'events' => $events, 'instancias' => $instancias]);
    }

    public function editRep($id)
    {
        $bread = DB::table('instituicoes')->leftjoin('instancias', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
            ->leftjoin('representacoes', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')->where('representacoes.cdRepresentacao', '=', $id)->first(['nmInstituicao', 'nmInstancia', 'instancias.cdInstituicao','cdRepresentacao']);
        $idcontracts = array();
        //$events=Instituicoe::find($id);
        $edit = Representacoe::join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('representacoes.cdRepresentacao', '=', $id)
            ->get(['representacoes.cdRepresentacao', 'dtInicioVigencia',
                'representacoes.cdInstancia', 'nmInstancia', 'representacoes.stAtivo', 'dtInicioVigencia',
                'dtFimVigencia','representacoes.dsObservacao']);

        $representantes = Representacao_representante::join('representante_suplentes', 'representante_suplentes.cdRepSup', '=', 'representacao_representantes.cdRepSup')
            ->where('cdRepresentacao', '=', $id)->orderby('nmRepresentanteSuplente')
            ->get(['nmRepresentanteSuplente', 'representacao_representantes.stRepresentante', 'stTitularidade', 'representacao_representantes.cdRepSup', 'dtFimNomeacao', 'dtInicioNomeacao', 'stRepresentante','cdRepresentacao']);

        $cdRepSUp = Representacao_representante::join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->where('representacao_representantes.cdRepresentacao', '=', $id)->get(['representante_suplentes.cdRepSup']);
        foreach ($cdRepSUp as $key) {
            if (!in_array($key->cdRepSup, $idcontracts)) {
                array_push($idcontracts, $key->cdRepSup);
            }
        }
        $cod = Representacoe::where('cdRepresentacao', '=', $id)->first(['cdRepresentacao']);
        $titulares = DB::table('representante_suplentes')->get();


        $anexo = Representacoe::join('representacoes_anexos', 'representacoes.cdRepresentacao', '=', 'representacoes_anexos.cdRepresentacao')->where('representacoes.cdRepresentacao', '=', $id)->get();
        // $insta = Instituicoe::join('tipo_instancias', 'tipo_instancias.cdTipoInstancia', '=','instituicoes.cdTipoInstituicao')->get();

        $insta = instancia::orderBy('nmInstancia')
            ->get();

        return view('representacoes.edit', ['selecionado' => $edit, 'lista' => $insta, 'anexo' => $anexo, 'representantes' => $representantes, 'titulares' => $titulares, 'cod' => $cod, 'bread' => $bread]);
    }

    public function addrepre(Request $request, $id)
    {
        $idcontracts = array();
        $bread = DB::table('instituicoes')->leftjoin('instancias', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
            ->leftjoin('representacoes', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')->where('representacoes.cdRepresentacao', '=', $id)->first(['nmInstituicao', 'nmInstancia', 'instancias.cdInstituicao','cdRepresentacao']);


        $event = new Representacao_representante;
        $event->cdRepSup = $request->cdRepSup;
        $event->dtInicioNomeacao = $request->dtInicioNomeacao;
        $event->cdRepresentacao = $id;
        $event->stRepresentante = $request->stRepresentante;
        $event->stTitularidade = '1';
        $event->dsDesiginacao = $request->dsDesiginacao;
        $event->dsNomeacao = $request->dsNomeacao;
        $event->save();

        $edit = Representacoe::join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('representacoes.cdRepresentacao', '=', $id)
            ->get(['representacoes.cdRepresentacao', 'dtInicioVigencia',
                'representacoes.cdInstancia', 'nmInstancia', 'representacoes.stAtivo', 'dtInicioVigencia',
                'dtFimVigencia', 'representacoes.dsObservacao']);

        $representantes = Representacao_representante::join('representante_suplentes', 'representante_suplentes.cdRepSup', '=', 'representacao_representantes.cdRepSup')
            ->where('cdRepresentacao', '=', $id)->orderby('nmRepresentanteSuplente')
            ->get(['nmRepresentanteSuplente', 'representacao_representantes.stRepresentante', 'stTitularidade', 'representacao_representantes.cdRepSup', 'dtFimNomeacao', 'dtInicioNomeacao', 'stRepresentante','cdRepresentacao']);

        $incluidos = Representacao_representante::join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->where('representacao_representantes.cdRepresentacao', '=', $id)->get(['nmRepresentanteSuplente', 'stRepresentante', 'representante_suplentes.cdRepSup']);

        $cdRepSUp = Representacao_representante::join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->where('representacao_representantes.cdRepresentacao', '=', $id)->get(['representante_suplentes.cdRepSup']);
        foreach ($cdRepSUp as $key) {
            if (!in_array($key->cdRepSup, $idcontracts)) {
                array_push($idcontracts, $key->cdRepSup);
            }
        }
        $cod = Representacoe::where('cdRepresentacao', '=', $id)->first(['cdRepresentacao']);

        $titulares = DB::table('representante_suplentes')->get();

        $anexo = Representacoe::join('representacoes_anexos', 'representacoes.cdRepresentacao', '=', 'representacoes_anexos.cdRepresentacao')->where('representacoes.cdRepresentacao', '=', $id)->get();
        // $insta = Instituicoe::join('tipo_instancias', 'tipo_instancias.cdTipoInstancia', '=','instituicoes.cdTipoInstituicao')->get();

        $insta = instancia::orderBy('nmInstancia')
            ->get();


        $titulares = DB::table('representante_suplentes')->whereNotIn('cdRepSup', $idcontracts)->get();

        return view('representacoes.edit', ['selecionado' => $edit, 'lista' => $insta, 'anexo' => $anexo, 'representantes' => $representantes, 'titulares' => $titulares, 'cod' => $cod, 'bread' => $bread, 'incluidos' => $incluidos]);
    }

    public function delrepre(Request $request, $id)
    {
        $idcontracts = array();

        Representacao_representante::where('cdRepSup', $id)->where('cdRepresentacao',$request->cdRepresentacao)->delete();
        $bread = DB::table('instituicoes')->leftjoin('instancias', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
            ->leftjoin('representacoes', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')->where('representacoes.cdRepresentacao', '=', $id)->first(['nmInstituicao', 'nmInstancia', 'instancias.cdInstituicao','representacoes.cdRepresentacao']);
        $edit = Representacoe::join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('representacoes.cdRepresentacao', '=', $id)
            ->get(['representacoes.cdRepresentacao', 'dtInicioVigencia',
                'representacoes.cdInstancia', 'nmInstancia', 'representacoes.stAtivo', 'dtInicioVigencia',
                'dtFimVigencia', 'representacoes.dsObservacao']);

        $representantes = Representacao_representante::join('representante_suplentes', 'representante_suplentes.cdRepSup', '=', 'representacao_representantes.cdRepSup')
            ->where('cdRepresentacao', '=', $id)
            ->get(['nmRepresentanteSuplente', 'representacao_representantes.stRepresentante', 'stTitularidade', 'representacao_representantes.cdRepSup', 'dtFimNomeacao', 'dtInicioNomeacao', 'stRepresentante']);


        $incluidos = Representacao_representante::join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->where('representacao_representantes.cdRepresentacao', '=', $id)->orderby('nmRepresentanteSuplente')->get(['nmRepresentanteSuplente', 'stRepresentante', 'representante_suplentes.cdRepSup']);

        $cdRepSUp = Representacao_representante::join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->where('representacao_representantes.cdRepresentacao', '=', $id)->get(['representante_suplentes.cdRepSup']);
        foreach ($cdRepSUp as $key) {
            if (!in_array($key->cdRepSup, $idcontracts)) {
                array_push($idcontracts, $key->cdRepSup);
            }
        }
        $cod = Representacoe::where('cdRepresentacao', '=', $id)->first(['cdRepresentacao']);
        $titulares = DB::table('representante_suplentes')->whereNotIn('cdRepSup', $idcontracts)->get();

        $anexo = Representacoe::join('representacoes_anexos', 'representacoes.cdRepresentacao', '=', 'representacoes_anexos.cdRepresentacao')->where('representacoes.cdRepresentacao', '=', $id)->get();
        // $insta = Instituicoe::join('tipo_instancias', 'tipo_instancias.cdTipoInstancia', '=','instituicoes.cdTipoInstituicao')->get();

        $insta = instancia::orderBy('nmInstancia')
            ->get();


        $titulares = DB::table('representante_suplentes')->whereNotIn('cdRepSup', $idcontracts)->get();
        return back()->withInput(['selecionado' => $edit, 'lista' => $insta, 'anexo' => $anexo, 'representantes' => $representantes, 'titulares' => $titulares, 'cod' => $cod, 'bread' => $bread]);
    }


    public function updateRep(Request $request, $id)
    {

        $data = $request->all();
        $caminho = $data['cdInstancia'];

        // Image Upload
        if ($request->has('fnNomeacao')) {
            $name = $request->file('fnNomeacao')->getClientOriginalName();
            $requestImage = $request->fnNomeacao;
            $data['dsOriginalNomeacao'] = $name;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('files'), $imageName);


            $data['fnNomeacao'] = $imageName;

        }

        Representacoe::find($request->id)->update($data);


        return redirect()->route('repre', ['id' => $caminho]);
    }

    public function editrepre(Request $request, $id)
    {
        $rep = $request->input('cdRepSup');
        $cd = $request->input('stTitularidade');
        $data = $request->input('dtInicioNomeacao');

        $obs = $request->input('dsDesiginacao');
        $nom = $request->input('dsNomeacao');
        if ($cd == 1) {
            $fim = NULL;
        }
        if ($cd == 0) {
            $fim = Carbon::now();
        }


        DB::update('update representacao_representantes set cdRepSup=?, stTitularidade = ?, dtInicioNomeacao = ?,dsDesiginacao = ?, dsNomeacao =? ,dtFimNomeacao= ? where cdRepSup = ?',
         [$rep,$cd, $data, $obs, $nom, $fim, $id]);


        return back();
    }

    public function repreinfo($empid = 0)
    {

        $representantes = Representacao_representante::join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->find($empid);
        $rep = DB::table('representante_suplentes')->where('cdRepSup','<>',$representantes->cdRepSup)->get(['cdRepSup','nmRepresentanteSuplente']);
        $html = "";
        if (!empty($representantes)) {
            $html = '<form action="/representacoes/representantes/add/'.$representantes->cdRepSup.'" method="post">
           ' . csrf_field() . '

           <div class="mb-3">
                <label for="disabledTextInput" class="form-label"  >Nome</label>
                <select name="cdRepSup" id="cdRepSup" class="form-select">
                <option value="'.$representantes->cdRepSup.'"> '.$representantes->nmRepresentanteSuplente.'</option>';
                 foreach( $rep as $re){
                    $html .= '
                           <option value="'.$re->cdRepSup.'"> '.$re->nmRepresentanteSuplente.'</option>

                 ';}
                 $html .= '

                </select>

            </div>

            <div class="form-group">
            <label for="title">Data de Nomeação:</label>
            <input type="date" class="form-control" id="dtInicioNomeacao" name="dtInicioNomeacao" value='.$representantes->dtInicioNomeacao.'>
    </div>

            <br>
            <div class="form-check">
                    <input class="form-check-input" type="radio" name="stTitularidade" id="stTitularidade" value="1"
                        ';
            if ($representantes->stTitularidade == 1) {
                $html .= ' checked ';
            }
            $html .= ' >
                    <label class="form-check-label" for="stTitularidade">
                        Ativo
                    </label>
            </div>

            <div class="form-check">
                    <input class="form-check-input" type="radio" name="stTitularidade" id="stTitularidade" value="0"
                    ';
            if ($representantes->stTitularidade == 0) {
                $html .= ' checked ';
            }
            $html .= '  >
                    <label class="form-check-label" for="stTitularidade">
                        Desativado
                    </label>
            </div>
            <div class="form-group">
                            <label for="title">Nomeação:</label>
                            <input type="text" class="form-control" id="dsNomeacao" name="dsNomeacao"  value="'.$representantes->dsNomeacao.'"
                            >
                        </div>
                        <div class="form-group">
                            <label for="title">Designação:</label>
                            <input type="text" class="form-control" id="dsDesiginacao" name="dsDesiginacao"  value="'.$representantes->dsDesiginacao.'">
                        </div>
                        <br>
            <input type="submit" class="btn btn-primary mb-2" value="Salvar">
            </form>';
        }
        $response['html'] = $html;

        return response()->json($response);
    }

    public function instareprescreate($id)
    {
        $bread = DB::table('instituicoes')->leftjoin('instancias', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
            ->leftjoin('representacoes', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')->where('instancias.cdInstancia', '=', $id)->first(['nmInstituicao', 'nmInstancia', 'instancias.cdInstituicao']);
        $representantes = DB::table('representante_suplentes')->orderby('nmRepresentanteSuplente')->get();
        $events = Representacoe::all();
        $instancias = DB::table('instancias')
            ->where('instancias.cdInstancia', '=', $id)
            ->get();
        $selecionado = DB::table('vw_representacoes')->where('cdInstancia', '=', $id)->get();

        return view('representacoes/repinsta', ['selecionado' => $selecionado, 'instancias' => $instancias, 'events' => $events, 'representantes' => $representantes, 'bread' => $bread]);
    }

    public function represcreate()
    {
        $representantes = DB::table('representacoes')
            ->join('representacao_representantes', 'representacoes.cdRepresentacao', '=', 'representacao_representantes.cdRepresentacao')
            ->join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->join('instancias', 'instancias.cdInstancia', '=', 'representacoes.cdInstancia')
            ->where('dsEmail', '=', auth()->user()->email)->get();


        return view('representacoes/representacoes', ['representantes' => $representantes]);
    }

    public function download(Request $request, $id)
    {

        //return response()->download('prjsgr1/storage/app/files/'.$id);

        $file = public_path() . "/files/$id";


        return \Response::download($file);
    }

    public function representacoesPorNumeroExportView()
    {
        $instancias = Instancia::join('tema_representacoes', 'tema_representacoes.cdTema', '=', 'instancias.cdTema')
            ->get();

        return view('exportsView/representacoesNumero', ['instancias' => $instancias]);
    }

    public function delinfo($empid = 0)
    {


        $employee = Representacao_representante::join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')->get(['cdRepresentacao','nmRepresentanteSuplente','representante_suplentes.cdRepSup'])
            ->find($empid);


        $html = "";

        if (!empty($employee)) {

            $html = '
                   <div class="modal-body">
                       A exclusão é permanente. Deseja prosseguir? ' . $employee->nmRepresentanteSuplente . '
                   </div>
                   <div class="modal-footer">
                       <form action="/representacoes/edit/' . $employee->cdRepSup . '" method="POST">
                       ' . csrf_field() . '
                       ' . method_field('DELETE') . '
                       <div class="form-group" >


                       <input style="display:none" type="text" class="form-control" id="cdRepresentacao"
                              name="cdRepresentacao" value="'.$employee->cdRepresentacao.'"
                       >
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

    public function repredelinfo($empid = 0)
    {


        $employee = Representacoe::find($empid);


        $html = "";

        if (!empty($employee)) {

            $html = '
                   <div class="modal-body">
                       A exclusão é permanente. Deseja prosseguir? ' . $employee->nmRepresentanteSuplente . '
                   </div>
                   <div class="modal-footer">
                       <form action="/repinsta/' . $employee->cdRepresentacao . '" method="POST">
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
        $representacoes = Representante_suplente::leftjoin('representacoes', 'representante_suplentes.cdRepSup', '=', 'representacoes.cdTitular')
            ->leftjoin('instancias', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
            ->get();


        return view('exportsView/representacoes', ['representacoes' => $representacoes]);
    }

    public function representacaoEmNumeroExportView()
    {
        $representacoes = DB::table('representacoes')
            ->join('instancias', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
            ->join('tema_representacoes', 'tema_representacoes.cdTema', '=', 'instancias.cdTema')
            ->select(DB::raw('count(instancias.cdInstancia) as inst_count,
                count(representacoes.cdRepresentacao) as rep_count, tema_representacoes.nmTema'))
            ->groupBy("tema_representacoes.nmTema")
            ->get();

        return view('exportsView/representacaoEmNumeros', ['representacoes' => $representacoes]);
    }

    public function expRepEmNum()
    {
        return (new ExpRepresentacaoEmNumeros())->download('expRepEmNum.xlsx');
    }

    public function relRepresentantesExportView()
    {
//          SELECT DISTINCT RS.nmRepresentanteSuplente AS REPRESENTANTE, I.nmInstancia AS INSTANCIA, RR.dsDesiginacao AS DESIGNACAO,
//          RR.dsNomeacao AS NOMEACAO, R.dtInicioVigencia AS INI_VIG, R.dtFimVigencia AS FIM_VIG, I.stAtivo AS STATUS
//          FROM INSTANCIAS I
//          JOIN REPRESENTACOES R ON R.cdInstancia = I.cdInstancia
//          JOIN REPRESENTACAO_REPRESENTANTES RR ON R.cdRepresentacao = RR.cdRepresentacao
//          JOIN REPRESENTANTE_SUPLENTES RS ON RR.cdRepSup = RS.cdRepSup
//          WHERE RR.stTitularidade = 1;
        $representacoes = DB::table('instancias')
            ->join('representacoes', 'representacoes.cdInstancia', '=', 'instancias.cdInstancia')
            ->join('representacao_representantes', 'representacoes.cdRepresentacao', '=', 'representacao_representantes.cdRepresentacao')
            ->join('representante_suplentes', 'representacao_representantes.cdRepSup', '=', 'representante_suplentes.cdRepSup')
            ->select(DB::raw('representante_suplentes.nmRepresentanteSuplente, instancias.nmInstancia, representacao_representantes.dsDesiginacao,
            representacao_representantes.dsNomeacao, representacoes.dtInicioVigencia, representacoes.dtFimVigencia, instancias.stAtivo'))
            ->distinct()
            ->where('representacao_representantes.stTitularidade', '=', 1)
            ->get();

        return view('exportsView/relRepresentantes', ['representacoes' => $representacoes]);
    }

    public function expRepresentantes()
    {
        return (new ExpRepresentantes)->download('expRepresentantes.xlsx');
    }
}
