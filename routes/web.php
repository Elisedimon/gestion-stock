<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\EntreeStockController;
use App\Http\Controllers\SortieStockController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategorieController::class);
    Route::resource('fournisseurs', FournisseurController::class);
    Route::resource('produits', ProduitController::class);
    Route::resource('entrees', EntreeStockController::class);
    Route::resource('sorties', SortieStockController::class);
    Route::get('/rapports/stock', [App\Http\Controllers\RapportController::class, 'stock'])->name('rapports.stock');
    Route::get('/rapports/mouvements', [App\Http\Controllers\RapportController::class, 'mouvements'])->name('rapports.mouvements');
});

require __DIR__.'/auth.php';