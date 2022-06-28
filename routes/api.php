<?php

use App\Http\Controllers\Admin\DespachoController;
use App\Http\Controllers\Admin\LocalController;
use App\Http\Controllers\Admin\SolicitacaoController;
use App\Http\Controllers\Admin\UnidadeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {


});

Route::get('despachos/todos', [DespachoController::class, 'apiListar']);
Route::post('despachos/excluir', [DespachoController::class, 'excluirDespacho']);


Route::get('equipamentos/todos/{local?}', [SolicitacaoController::class, 'equipamentos'])
    ->name('equipamentos.todos');

Route::get('equipamentos/unidades', [UnidadeController::class, 'listEquipamentos'])
    ->name('unidades.listaEquipamentos');

Route::get('locais/todos', [LocalController::class, 'locais'])
    ->name('local.todos');

Route::get('locais/todos/exceto/{id}', [LocalController::class, 'locaiExceto'])
    ->name('local.exceto');

https://app.4-trace.com.br/admin/home
