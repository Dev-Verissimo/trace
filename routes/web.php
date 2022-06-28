<?php

use App\Http\Controllers\Admin\ArquivoEquipController as ArquivoEquipamentoController;
use App\Http\Controllers\Admin\BuscarController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\DespachoController;
use App\Http\Controllers\Admin\EquipamentoController;
use App\Http\Controllers\Admin\InspecaoController;
use App\Http\Controllers\Admin\RelatorioController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SolicitacaoController;
use App\Http\Controllers\Admin\UnidadeController;
use App\Http\Controllers\Admin\FabricanteController;
use App\Http\Controllers\Admin\LocalController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::group(['prefix' => 'admin', 'namespace' => '', 'as' => 'admin.'], function () {
    /* Formulário de Login*/
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.do');

    /*  Rotas protegidas    */
    Route::group(['middleware' => ['auth']], function () {

        /* Dashboard Home*/
        Route::get('/home', [AuthController::class, 'home'])->name('home');

        /*  Usuários */
        Route::get('usuarios/{id}/excluir', [UserController::class, 'show'])->name('usuarios.show');
        Route::resource('usuarios', UserController::class)->except('show');

       /* Roles */
        Route::resource('roles', RoleController::class);

        /* Fabricante */
        Route::resource('fabricante', FabricanteController::class);

        /* Categoria */
        Route::resource('categoria', CategoriaController::class);

        /* Equipamento */
        Route::resource('equipamento', EquipamentoController::class);

        /*Unidade*/
        Route::get('equipamento/{id}/unidade', [UnidadeController::class, 'index'])->name('unidade.index');
        Route::get('equipamento/{id}/create', [UnidadeController::class, 'create'])->name('unidade.create');
        Route::get('equipamento/unidade/lista', [UnidadeController::class, 'lista'])->name('unidade.lista');

        /* Unidade*/
        Route::resource('unidade', UnidadeController::class)->except('index', 'create');

        /* Inspeção */
        Route::get('equipamento/unidade/{id}/inspecao', [InspecaoController::class, 'index'])->name('inspecao.index');
        Route::post('equipamento/unidade/inspecao/store/{id}', [InspecaoController::class, 'store'])->name('inspecao.store');


        /* Local */
        Route::resource('local', LocalController::class);

        /* Relatório*/
        Route::get('relatorio', [RelatorioController::class, 'index'])->name('relatorio.index');
        Route::get('relatorio/load-files', [RelatorioController::class, 'loadFilesIndex']);
        Route::post('relatorio/gerar-relatorio', [RelatorioController::class, 'gerarRelatorio'])->name('relatorio.gerar');
        Route::get('relatorio/exportar-relatorio', [RelatorioController::class, 'exportar'])->name('relatorio.exportar');

        /* Solicitação */
        Route::get('solicitacao/lista', [SolicitacaoController::class, 'lista'])->name('solicitacao.lista');
        Route::get('solicitacao/lista-detalhes/{id}', [SolicitacaoController::class, 'listaDetalhes'])->name('solicitacao.listadetalhes');
        Route::get('solicitacao/lista-detalhes/{id}/excluir', [SolicitacaoController::class, 'excluir'])->name('solicitacao.excluir');
        Route::post('solicitacao/despacho', [SolicitacaoController::class, 'storeDespacho'])->name('solicitacao.storeDespacho');
        Route::resource('solicitacao', SolicitacaoController::class);

        /*  Despacho */
        Route::get('despacho', [DespachoController::class, 'listar'])->name('despacho.lista');
        Route::get('despacho/lista-detalhes/{id}', [DespachoController::class, 'listaDetalhes'])->name('despacho.detalhes');
        Route::get('despacho/finalizar/{despachoId}', [DespachoController::class, 'acetarDespacho'])->name('despacho.acetarDespacho');

        /* Arquivos */
        Route::get('equipamento/arquivos/{id}', [ArquivoEquipamentoController::class, 'index'])->name('arquivo.index');
        Route::get('equipamento/arquivos/{id}/create', [ArquivoEquipamentoController::class, 'create'])->name('arquivo.create');
        Route::post('equipamento/arquivos/store', [ArquivoEquipamentoController::class, 'store'])->name('arquivo.store');
        Route::get('equipamento/arquivos/{id}/show', [ArquivoEquipamentoController::class, 'show'])->name('arquivo.show');
        Route::delete('equipamento/arquivos/{id}/delete', [ArquivoEquipamentoController::class, 'destroy'])->name('arquivo.destroy');
        Route::get('equipamento/arquivos/{id}/edit', [ArquivoEquipamentoController::class, 'edit'])->name('arquivo.edit');
        Route::put('equipamento/arquivos/{id}/update', [ArquivoEquipamentoController::class, 'update'])->name('arquivo.update');

        Route::post('buscar', [BuscarController::class, 'pesquisar'])->name('busca.pesquisa');
        Route::get('buscar/index', [BuscarController::class, 'index'])->name('busca.index');


    });

    /* Logout */
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

});
