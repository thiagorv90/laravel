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

Route::post("/logout",[LogoutController::class,"store"])->name("logout");


Route::group(['middleware' => 'auth'], function() {
    Route::get('inicial', [InstaciaController::class, 'dash']);
    Route::get('representacoes',[RepresentacoesController::class,'representacoescreate']);
    Route::get('agendas/{id}',[AgendasController::class,'agendacreate'])->name('agendas');
    Route::post('agendas/{id}',[AgendasController::class,'agendastore']);

Route::get('agendas/edit/{id}', [AgendasController::class, 'editAgen']);
Route::PUT('agendas/update/{id}', [AgendasController::class, 'updateAgen']);
    Route::get('instancias/show/{id}', [InstaciaController::class, 'show']);
        Route::get('instancias/edit/{cdInstancia}', [InstaciaController::class, 'edit']);
Route::PUT('instancias/update/{cdInstancia}', [InstaciaController::class, 'update']);
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::group(['middleware' => 'admin'], function() {

        Route::get('/usuarios',[UserController::class,'show']);
        Route::get('/usuarios/edit/{id}',[UserController::class,'edit']);
        Route::PUT('/usuarios/update/{id}', [UserController::class, 'update']);
        Route::get('/usuarios/searchusu',[UserController::class,'search'])->name('searchusu');

Route::post('empresas',[EventController::class,'store']);
Route::get('empresas',[EventController::class,'dashe']);
Route::PUT('empresas/update/{emp}', [EventController::class, 'updateEmp']);
Route::get('empresas/edit/{emp}', [EventController::class, 'editEmp']);

Route::post('inicial/',[InstaciaController::class,'searchinst']);
Route::post('instancias/{id}',[InstaciaController::class,'storeinst']);
Route::get('instancias/{id}', [InstaciaController::class, 'instacreate'])->name('instancias');

Route::get('contatos/search',[ContatoController::class,'search'])->name('searchco');
Route::post('contatos/listacontato/{id}',[ContatoController::class,'contastore']);

Route::get('contatos/edit/{id}', [ContatoController::class, 'editCon']);
Route::PUT('contatos/update/{id}', [ContatoController::class, 'updateCon']);
Route::get('contatos/listacontato/{id}',[ContatoController::class,'contalista'])->name('contatos');



Route::delete('/agendas/edit/{id}',[AgendasController::class, 'deleteAgen']);


Route::post('escolaridade',[EscolaridadeController::class,'escolaridadestore']);
Route::get('escolaridade',[EscolaridadeController::class,'escolaridadeindex']);
Route::PUT('escolaridade/update/{id}', [EscolaridadeController::class, 'updateEsc']);
Route::get('escolaridade/edit/{id}', [EscolaridadeController::class, 'editEsc']);


Route::post('instituicoes',[InstituicoesController::class,'instituicoesstore']);
Route::get('instituicoes',[InstituicoesController::class,'instituicoesindex']);
Route::get('instituicoes',[InstituicoesController::class,'instituicoescreate']);
Route::PUT('instituicoes/update/{id}', [InstituicoesController::class, 'updateInst']);
Route::get('instituicoes/edit/{id}', [InstituicoesController::class, 'editInst']);

Route::post('representacoes',[RepresentacoesController::class,'representacoesstore']);
Route::post('repinsta/{id}',[RepresentacoesController::class,'representacoesstore']);
Route::get('repinsta/{id}',[RepresentacoesController::class,'instareprescreate'])->name('repre');
Route::PUT('representacoes/update/{id}', [RepresentacoesController::class, 'updateRep']);
Route::get('representacoes/edit/{id}', [RepresentacoesController::class, 'editRep']);

Route::post('repsup',[RepresentanteSuplenteController::class,'repsupstore']);
Route::get('repsup',[RepresentanteSuplenteController::class,'repsupcreate']);
Route::get('selerepsup/{id}',[RepresentanteSuplenteController::class,'selerepsup']);
Route::PUT('repsup/update/{id}', [RepresentanteSuplenteController::class, 'updateRepSup']);
Route::get('repsup/edit/{id}', [RepresentanteSuplenteController::class, 'editRepSup']);

Route::post('/telcon/{id}',[TelefoneContatosController::class,'telconstore']);
Route::get('/telcon/{id}',[TelefoneContatosController::class,'telconcreate'])->name('telcon');
Route::PUT('/telcon/update/{id}', [TelefoneContatosController::class, 'updateTel']);
Route::get('/telcon/edit/{id}', [TelefoneContatosController::class, 'editTel']);
Route::delete('/telcon/edit/{id}',[TelefoneContatosController::class, 'deleteTel']);


Route::post('telrepsup',[TelefoneRepresentanteSuplenteController::class,'telrepsupstore']);
Route::get('telrepsup/{id}',[TelefoneRepresentanteSuplenteController::class,'telrepsupcreate']);
Route::get('telrepsup/edit/{id}', [TelefoneRepresentanteSuplenteController::class, 'editTrel']);
Route::PUT('telrepsup/update/{id}', [TelefoneRepresentanteSuplenteController::class, 'updateTrel']);
Route::delete('/telrepsup/edit/{id}',[TelefoneRepresentanteSuplenteController::class, 'deleteTrel']);

Route::post('temarep',[TemaRepresentacoesController::class,'temarepstore']);
Route::get('temarep',[TemaRepresentacoesController::class,'temarepindex']);
Route::PUT('temarep/update/{id}', [TemaRepresentacoesController::class, 'updateTem']);
Route::get('temarep/edit/{id}', [TemaRepresentacoesController::class, 'editTem']);

Route::post('tipoinsta',[TipoInstanciaController::class,'tipoinstastore']);
Route::get('tipoinsta',[TipoInstanciaController::class,'tipoinstaindex']);
Route::PUT('tipoinsta/update/{id}', [TipoInstanciaController::class, 'updateTipo']);
Route::get('tipoinsta/edit/{id}', [TipoInstanciaController::class, 'editTipo']);

Route::view('autenrep', 'autenrep');

Route::get('autenrep',[authrepController::class,'authindex']);
Route::get('autenrep',[authrepController::class,'authcreate']);



Route::view('auth/register','auth/register');
});
});