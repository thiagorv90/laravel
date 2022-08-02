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
use App\Http\Controllers\InstaciaController;
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




Route::group(['middleware' => 'auth'], function () {
    Route::get('inicial', [InstaciaController::class, 'dash']);
    Route::get('representacoes', [RepresentacoesController::class, 'representacoescreate']);
    Route::get('representacoes', [RepresentacoesController::class, 'represcreate']);
    Route::get('agendas/{id}', [AgendasController::class, 'agendacreate'])->name('agendas');
    Route::post('agendas/{id}', [AgendasController::class, 'agendastore']);
    Route::get('agendas/{id}/search', [AgendasController::class, 'search']);

    Route::get('agendas/edit/{id}', [AgendasController::class, 'editAgen']);
    Route::PUT('agendas/update/{id}', [AgendasController::class, 'updateAgen']);

    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::group(['middleware' => 'admin'], function () {
        Route::view('/reports', 'reports');

        Route::get('instancias/show/{id}', [InstaciaController::class, 'show']);
        Route::get('instancias/edit/{cdInstancia}', [InstaciaController::class, 'edit']);
        Route::PUT('instancias/update/{cdInstancia}', [InstaciaController::class, 'update']);
        Route::get('/instancias/{id}/search', [InstaciaController::class, 'search']);

        Route::get('/usuarios', [UserController::class, 'show']);
        Route::get('/usuarios/edit/{id}', [UserController::class, 'edit']);
        Route::PUT('/usuarios/update/{id}', [UserController::class, 'update']);
        Route::get('/usuarios/search', [UserController::class, 'search'])->name('searchusu');

        Route::post('empresas', [EventController::class, 'store']);
        Route::get('empresas', [EventController::class, 'dashe']);
        Route::PUT('empresas/update/{emp}', [EventController::class, 'updateEmp']);
        Route::get('empresas/edit/{emp}', [EventController::class, 'editEmp']);
        Route::get('empresas/{id}/search', [EventController::class, 'search']);

        Route::post('inicial/', [InstaciaController::class, 'searchinst']);
        Route::post('instancias/{id}', [InstaciaController::class, 'storeinst']);
        Route::get('instancias/{id}', [InstaciaController::class, 'instacreate'])->name('instancias');
        Route::get('/dashboard/export/{id}', [InstaciaController::class, 'export'])->name('excel');

        Route::get('/contatos/{id}/search', [ContatoController::class, 'search'])->name('searchco');
        Route::post('contatos/listacontato/{id}', [ContatoController::class, 'contastore']);

        Route::get('contatos/edit/{id}', [ContatoController::class, 'editCon']);
        Route::PUT('contatos/update/{id}', [ContatoController::class, 'updateCon']);
        Route::get('contatos/listacontato/{id}', [ContatoController::class, 'contalista'])->name('contatos');

        Route::delete('/agendas/edit/{id}', [AgendasController::class, 'deleteAgen']);

        Route::post('escolaridade', [EscolaridadeController::class, 'escolaridadestore']);
        Route::get('escolaridade', [EscolaridadeController::class, 'escolaridadeindex']);
        Route::PUT('escolaridade/update/{id}', [EscolaridadeController::class, 'updateEsc']);
        Route::get('escolaridade/edit/{id}', [EscolaridadeController::class, 'editEsc']);
        Route::get('escolaridade/{id}/search', [EscolaridadeController::class, 'search']);

        Route::get('/instituicoes/{id}/search', [InstituicoesController::class, 'search'])->name('searchinst');
        Route::post('instituicoes', [InstituicoesController::class, 'instituicoesstore']);
        Route::get('instituicoes', [InstituicoesController::class, 'instituicoesindex']);
        Route::get('instituicoes', [InstituicoesController::class, 'instituicoescreate']);
        Route::PUT('instituicoes/update/{id}', [InstituicoesController::class, 'updateInst']);
        Route::get('instituicoes/edit/{id}', [InstituicoesController::class, 'editInst']);


        Route::post('repinsta/{id}', [RepresentacoesController::class, 'representacoesstore']);
        Route::get('repinsta/{id}', [RepresentacoesController::class, 'instareprescreate'])->name('repre');
        Route::PUT('representacoes/update/{id}', [RepresentacoesController::class, 'updateRep']);
        Route::get('representacoes/edit/{id}', [RepresentacoesController::class, 'editRep']);

        Route::post('repsup', [RepresentanteSuplenteController::class, 'repsupstore']);
        Route::get('repsup', [RepresentanteSuplenteController::class, 'repsupcreate']);
        Route::get('selerepsup/{id}', [RepresentanteSuplenteController::class, 'selerepsup']);
        Route::PUT('repsup/update/{id}', [RepresentanteSuplenteController::class, 'updateRepSup']);
        Route::get('repsup/edit/{id}', [RepresentanteSuplenteController::class, 'editRepSup']);

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

        Route::view('autenrep', 'autenrep');

        Route::get('autenrep', [authrepController::class, 'authindex']);
        Route::get('autenrep', [authrepController::class, 'authcreate']);


        Route::get('export/representacoes/', [RepresentacoesController::class, 'export'])->name('porRepresentante');
        Route::get('export/instancias/', [InstaciaController::class, 'exportPorId'])->name('porInstancia');
        Route::get('export/repEmNumeros/', [RepresentacoesController::class, 'exportRepEmNumeros'])->name('repEmNumeros');
        Route::get('export/instanciasPorStatus', [InstaciaController::class, 'exportPorStatus'])->name('porStatus');
        Route::get('export/instanciasPorTema', [InstaciaController::class, 'exportPorTema'])->name('porTema');
        Route::get('export/instanciasPorPrioridade', [InstaciaController::class, 'exportPorPrioridade'])->name('porPrioridade');
        Route::get('export/instanciasPorVigencia', [InstaciaController::class, 'exportPorVigencia'])->name('porVigencia');
        Route::get('export/instanciasPorData', [InstaciaController::class, 'exportPorData'])->name('porData');


        Route::get('exportView/instancias/', [InstaciaController::class, 'instanciasExportView'])->name('exportViewInstancias');
        Route::get('exportView/instanciasData/', [InstaciaController::class, 'instanciasDataExportView'])->name('exportViewInstData');
        Route::get('exportView/instanciasPorId/', [InstaciaController::class, 'instanciasPorIdExportView'])->name('exportViewInstId');
        Route::get('exportView/instanciasPorPrioridade/', [InstaciaController::class, 'instanciasPorPrioridadeExportView'])->name('exportViewInstPrioridade');
        Route::get('exportView/instanciasPorTema/', [InstaciaController::class, 'instanciasPorTemaView'])->name('exportViewInstTema');
        Route::get('exportView/instanciasPorVigencia/', [InstaciaController::class, 'instanciasPorVigenciaView'])->name('exportViewInstVigencia');
        Route::get('exportView/instanciasPorStatus/', [InstaciaController::class, 'instanciasPorStatusExportView'])->name('exportViewInstStatus');
        Route::get('exportView/representantes/', [RepresentacoesController::class, 'representacoesExportView'])->name('exportViewRepresentacoes');
        Route::get('exportView/representacoesEmNumero/', [RepresentacoesController::class, 'representacoesPorNumeroExportView'])->name('exportViewRepresentacoesNum');

        Route::get('exportView/instanciasPorVigenciaFiltrada/', [InstaciaController::class, 'relatorioFiltrado'])->name('filtradoInstanciaPorVigencia');
    });
});
