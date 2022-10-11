<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\EventController;
use App\Http\Controllers\InstanciaController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\AgendasController;
use App\Http\Controllers\EscolaridadeController;
use App\Http\Controllers\InstituicoesController;
use App\Http\Controllers\RepresentacoesController;
use App\Http\Controllers\RepresentanteSuplenteController;
use App\Http\Controllers\TelefoneContatosController;
use App\Http\Controllers\TelefoneRepresentanteSuplenteController;
use App\Http\Controllers\TemaRepresentacoesController;
use App\Http\Controllers\TipoInstanciaController;
use App\Http\Controllers\authrepController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Admin\UserController;

require_once __DIR__ . '/jetstream.php';

Route::get('/', function () {
    return view('auth/login');
});

Route::middleware('auth')->group(function () {


    Route::get('representacoes', [RepresentacoesController::class, 'representacoescreate']);
    Route::get('representacoes', [RepresentacoesController::class, 'represcreate']);
    Route::get('agendas/{id}', [AgendasController::class, 'agendacreate'])->name('agendas');
    Route::post('agendas/{id}', [AgendasController::class, 'agendastore']);
    Route::get('/dashboard', [AgendasController::class, 'dashboard']);
    Route::get('agendas/{id}/search', [AgendasController::class, 'search']);

    Route::get('agendas/edit/{id}', [AgendasController::class, 'editAgen']);
    Route::PUT('agendas/update/{id}', [AgendasController::class, 'updateAgen']);
    Route::get('/download/{id}', [RepresentacoesController::class, 'download']);
    Route::get('/downloadAgen/{id}', [AgendasController::class, 'downloadAgen']);

    Route::group(['middleware' => 'admin'], function () {
        Route::view('/reports', 'reports');
        Route::get('inicial', [InstanciaController::class, 'dash']);

        
        Route::get('/typeahead_autocomplete', [InstanciaController::class, 'index']);
        Route::get('/typeahead_autocomplete/action', [InstanciaController::class, 'action'])->name('typeahead_autocomplete.action');
        Route::get('instancias/show/{id}', [InstanciaController::class, 'show']);
        Route::get('instancias/edit/{cdInstancia}', [InstanciaController::class, 'edit']);
        Route::PUT('instancias/update/{cdInstancia}', [InstanciaController::class, 'update']);
        Route::get('/instancias/{id}/search', [InstanciaController::class, 'search']);


        Route::get('/usuarios', [UserController::class, 'show']);
        Route::get('/usuarios/edit/{id}', [UserController::class, 'edit']);
        Route::delete('/usuarios/edit/{id}', [UserController::class, 'delete']);
        Route::PUT('/usuarios/update/{id}', [UserController::class, 'update']);
        Route::get('/usuarios/search', [UserController::class, 'search'])->name('searchusu');

        Route::post('empresas', [EventController::class, 'store']);
        Route::get('empresas', [EventController::class, 'dashe']);
        Route::PUT('empresas/update/{emp}', [EventController::class, 'updateEmp']);
        Route::get('empresas/edit/{emp}', [EventController::class, 'editEmp']);
        Route::get('empresas/{id}/search', [EventController::class, 'search']);

        Route::post('inicial/', [InstanciaController::class, 'searchinst']);
        Route::post('instancias/{id}', [InstanciaController::class, 'storeinst']);
        Route::get('instancias/{id}', [InstanciaController::class, 'instacreate'])->name('instancias');
        Route::post('/instancias/file/{id}', [InstanciaController::class, 'instanciafile']);
        Route::delete('/instancias/{id}', [InstanciaController::class, 'deleteInsta']);
        Route::delete('/instancias/files/{id}', [InstanciaController::class, 'deleteInstnImg']);
        Route::get('/dashboard/export/{id}', [InstanciaController::class, 'export'])->name('excel');

        Route::get('/contatos/{id}/search', [ContatoController::class, 'search'])->name('searchco');
        Route::post('contatos/listacontato/{id}', [ContatoController::class, 'contastore']);

        Route::get('contatos/edit/{id}', [ContatoController::class, 'editCon']);
        Route::PUT('contatos/update/{id}', [ContatoController::class, 'updateCon']);
        Route::get('contatos/listacontato/{id}', [ContatoController::class, 'contalista'])->name('contatos');


        Route::post('/agendas/file/{id}', [AgendasController::class, 'agendafile']);
        Route::delete('/agendas/edit/{id}', [AgendasController::class, 'deleteAgen']);
        Route::delete('/agendas/files/{id}', [AgendasController::class, 'deleteAgenImg']);


        Route::post('escolaridade', [EscolaridadeController::class, 'escolaridadestore']);
        Route::get('escolaridade', [EscolaridadeController::class, 'escolaridadeindex']);
        Route::PUT('escolaridade/update/{id}', [EscolaridadeController::class, 'updateEsc']);
        Route::get('escolaridade/edit/{id}', [EscolaridadeController::class, 'editEsc']);
        Route::get('escolaridade/{id}/search', [EscolaridadeController::class, 'search']);


        Route::get('/instituicoes/{id}/search', [InstituicoesController::class, 'search']);
        
        Route::get('/instituicoes/searchinsta', [InstituicoesController::class, 'insta']);
        Route::post('instituicoes', [InstituicoesController::class, 'instituicoesstore']);
        Route::get('instituicoes', [InstituicoesController::class, 'instituicoesindex']);
        Route::get('instituicoes', [InstituicoesController::class, 'instituicoescreate']);
        Route::PUT('instituicoes/update/{id}', [InstituicoesController::class, 'updateInst']);
        Route::get('instituicoes/edit/{id}', [InstituicoesController::class, 'editInst']);


        Route::post('repinsta/{id}', [RepresentacoesController::class, 'representacoesstore']);
        Route::get('repinsta/{id}', [RepresentacoesController::class, 'instareprescreate'])->name('repre');
        Route::PUT('representacoes/update/{id}', [RepresentacoesController::class, 'updateRep']);
        Route::get('representacoes/edit/{id}', [RepresentacoesController::class, 'editRep'])->name('editrepre');
        Route::post('representacoes/edit/{id}', [RepresentacoesController::class, 'addrepre']);
        Route::delete('representacoes/edit/{id}', [RepresentacoesController::class, 'delrepre']);
        Route::post('/representacoes/file/{id}', [RepresentacoesController::class, 'representacoesfile']);
        Route::delete('/representacoes/files/{id}', [RepresentacoesController::class, 'deleteRepreImg']);
        Route::post('/representacoes/representantes/{id}', [RepresentacoesController::class, 'createrep']);
        Route::delete('/representacoes/representantes/{id}', [RepresentacoesController::class, 'deleterep']);
        Route::get('/getEmployeeDetails/{empid}', [RepresentacoesController::class, 'repreinfo'])->name('getEmployeeDetails');
        Route::post('/representacoes/representantes/add/{id}', [RepresentacoesController::class, 'editrepre']);

        Route::post('repsup', [RepresentanteSuplenteController::class, 'repsupstore']);
        Route::get('repsup', [RepresentanteSuplenteController::class, 'repsupcreate'])->name('representantes');
        Route::get('selerepsup/{id}', [RepresentanteSuplenteController::class, 'selerepsup']);
        Route::PUT('repsup/update/{id}', [RepresentanteSuplenteController::class, 'updateRepSup']);
        Route::get('repsup/edit/{id}', [RepresentanteSuplenteController::class, 'editRepSup']);
        Route::delete('repsup/edit/{id}', [RepresentanteSuplenteController::class, 'deleteRep']);
        Route::post('/repsup/file/{id}', [RepresentanteSuplenteController::class, 'repsupfile']);
        Route::delete('/repsup/files/{id}', [RepresentanteSuplenteController::class, 'deleteRepImg']);
        Route::get('/repsup/search', [RepresentanteSuplenteController::class, 'search']);

        Route::post('/telcon/{id}', [TelefoneContatosController::class, 'telconstore']);
        Route::get('/telcon/{id}', [TelefoneContatosController::class, 'telconcreate'])->name('telcon');
        Route::PUT('/telcon/update/{id}', [TelefoneContatosController::class, 'updateTel']);
        Route::get('/telcon/edit/{id}', [TelefoneContatosController::class, 'editTel']);
        Route::delete('/telcon/edit/{id}', [TelefoneContatosController::class, 'deleteTel']);


        Route::post('/telrepsup/{id}', [TelefoneRepresentanteSuplenteController::class, 'telrepsupstore']);
        Route::get('/telrepsup/{id}', [TelefoneRepresentanteSuplenteController::class, 'telrepsupcreate']);

        Route::get('telrepsup/edit/{id}', [TelefoneRepresentanteSuplenteController::class, 'editTrel']);
        Route::PUT('telrepsup/update/{id}', [TelefoneRepresentanteSuplenteController::class, 'updateTrel']);
        Route::delete('/telrepsup/edit/{id}', [TelefoneRepresentanteSuplenteController::class, 'deleteTrel']);

        Route::post('temarep', [TemaRepresentacoesController::class, 'temarepstore']);
        Route::get('temarep', [TemaRepresentacoesController::class, 'temarepindex']);
        Route::PUT('temarep/update/{id}', [TemaRepresentacoesController::class, 'updateTem']);
        Route::get('temarep/edit/{id}', [TemaRepresentacoesController::class, 'editTem']);
        Route::get('/temarep/{id}/search', [TemaRepresentacoesController::class, 'search']);

        Route::post('tipoinsta', [TipoInstanciaController::class, 'tipoinstastore']);
        Route::get('tipoinsta', [TipoInstanciaController::class, 'tipoinstaindex']);
        Route::PUT('tipoinsta/update/{id}', [TipoInstanciaController::class, 'updateTipo']);
        Route::get('tipoinsta/edit/{id}', [TipoInstanciaController::class, 'editTipo']);
        Route::get('/tipoinsta/{id}/search', [TipoInstanciaController::class, 'search'])->name('searchtipinst');


        Route::get('export/representacoes/', [RepresentacoesController::class, 'export'])->name('porRepresentante');
        Route::get('export/instancias/', [InstanciaController::class, 'exportPorId'])->name('porInstancia');
        Route::get('export/repEmNumeros/', [RepresentacoesController::class, 'exportRepEmNumeros'])->name('repEmNumeros');
        Route::get('export/instanciasPorStatus', [InstanciaController::class, 'exportPorStatus'])->name('porStatus');
        Route::get('export/instanciasPorTema', [InstanciaController::class, 'exportPorTema'])->name('porTema');
        Route::get('export/instanciasPorPrioridade', [InstanciaController::class, 'exportPorPrioridade'])->name('porPrioridade');
        Route::get('export/instanciasPorVigencia', [InstanciaController::class, 'exportPorVigencia'])->name('porVigencia');
        Route::get('export/instanciasPorData', [InstanciaController::class, 'exportPorData'])->name('porData');
        Route::get('export/agendas/', [AgendasController::class, 'export'])->name('porAgendas');
        Route::get('export/agendasFiltrada/', [AgendasController::class, 'exportfiltrada'])->name('porFiltroAgendas');

        Route::get('exportView/agendas', [AgendasController::class, 'exportViewAgendas'])->name('exportViewAgendas');
        Route::get('exportView/instancias/', [InstanciaController::class, 'instanciasExportView'])->name('exportViewInstancias');
        Route::get('exportView/instanciasData/', [InstanciaController::class, 'instanciasDataExportView'])->name('exportViewInstData');
        Route::get('exportView/instanciasPorId/', [InstanciaController::class, 'instanciasPorIdExportView'])->name('exportViewInstId');
        Route::get('exportView/instanciasPorPrioridade/', [InstanciaController::class, 'instanciasPorPrioridadeExportView'])->name('exportViewInstPrioridade');
        Route::get('exportView/instanciasPorTema/', [InstanciaController::class, 'instanciasPorTemaView'])->name('exportViewInstTema');
        Route::get('exportView/instanciasPorVigencia/', [InstanciaController::class, 'instanciasPorVigenciaView'])->name('exportViewInstVigencia');
        Route::get('exportView/instanciasPorStatus/', [InstanciaController::class, 'instanciasPorStatusExportView'])->name('exportViewInstStatus');
        Route::get('exportView/representantes/', [RepresentacoesController::class, 'representacoesExportView'])->name('exportViewRepresentacoes');
        Route::get('exportView/representacoesEmNumero/', [RepresentacoesController::class, 'representacoesPorNumeroExportView'])->name('exportViewRepresentacoesNum');

        Route::get('exportView/instanciasPorVigenciaFiltrada/', [InstanciaController::class, 'relatorioFiltrado'])->name('filtradoInstanciaPorVigencia');
        Route::get('exportView/agendaFiltrada/', [AgendasController::class, 'relatorioFiltrado'])->name('filtradoAgenda');

        Route::get('export/agendaReuniao', [AgendasController::class, 'exportAgendaReuniao'])->name('exportAgendaReuniao');
        Route::get('export/agendaReuniaoDiaria', [AgendasController::class, 'exportAgendaReuniaoDiaria'])->name('exportAgendaReuniaoDiaria');
        Route::get('export/agendaReuniaoSemanal', [AgendasController::class, 'exportAgendaReuniaoSemanal'])->name('exportAgendaReuniaoSemanal');
        Route::get('export/agendaReuniaoMensal', [AgendasController::class, 'exportAgendaReuniaoMensal'])->name('exportAgendaReuniaoMensal');
        Route::get('exportView/agendaReuniao', [AgendasController::class, 'exportViewAgendasReuniao'])->name('agendaReuniao');
    });
});


