<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CreditRequestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CreditAnalysisController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\Admin\InvestmentController as AdminInvestmentController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    // Saldo / Extrato 
    Route::get('/extrato', [AccountController::class, 'statement'])->name('account.statement');

    // Depósito 
    Route::get('/deposito', [TransactionController::class, 'depositForm'])->name('transaction.deposit');
    Route::post('/deposito', [TransactionController::class, 'deposit']);

    // Transferência 
    Route::get('/transferencia', [TransactionController::class, 'transferForm'])->name('transaction.transfer');
    Route::post('/transferencia', [TransactionController::class, 'transfer']);

    // Crédito 
    Route::get('/credito/solicitar', [CreditRequestController::class, 'create'])->name('credit.request');
    Route::post('/credito/solicitar', [CreditRequestController::class, 'store']);

    // Investimentos 
    Route::get('/investimentos', [InvestmentController::class, 'index'])->name('investments.index');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Gerenciar usuários 
        Route::resource('users', UserController::class);

        // Avaliação de crédito 
        Route::get('credits', [CreditAnalysisController::class, 'index'])->name('credits.index');
        Route::post('credits/{creditRequest}', [CreditAnalysisController::class, 'update'])->name('credits.update');

        // Gerenciar investimentos
        Route::resource('investments', AdminInvestmentController::class);
    });

require __DIR__ . '/auth.php';
