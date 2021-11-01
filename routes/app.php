<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, FuncionarioController, MovimentacaoController};

Route::prefix('/')->middleware(['auth:administrador,funcionario'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('funcionarios')->name('funcionario.')->group(function () {
        Route::get('/', [FuncionarioController::class, 'index'])->name('pesquisar');
        Route::get('/extrato/{id}', [FuncionarioController::class, 'extrato'])->name('extrato');

        Route::get('cadastrar', [FuncionarioController::class, 'create'])->name('cadastrar');
        Route::post('cadastrar', [FuncionarioController::class, 'store']);

        Route::get('editar/{id}', [FuncionarioController::class, 'edit'])->name('editar');
        Route::post('editar/{id}', [FuncionarioController::class, 'update']);

        Route::delete('deletar/{id}', [FuncionarioController::class, 'destroy']);
    });

    Route::prefix('movimentacao')->name('movimentacao.')->group(function () {
        Route::get('/', [MovimentacaoController::class, 'index'])->name('pesquisar');

        Route::get('/funcionarios', [MovimentacaoController::class, 'funcionarios'])->name('funcionarios');

        Route::get('/cadastrar/{id}', [MovimentacaoController::class, 'create'])->name('cadastrar');
        Route::post('/cadastrar/{id}  ', [MovimentacaoController::class, 'store']);

        Route::get('/ultimasMovimentacoes  ', [MovimentacaoController::class, 'ultimasMovimentacoes']);
    });
});
