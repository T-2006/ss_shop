<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\VarianteController;


Route::get('/', [InicioController::class, 'index'])->name('inicio');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [PanelController::class, 'index'])->name('inicio');

    Route::resource('categorias', CategoriaController::class)->except('show');

    Route::resource('productos', ProductoController::class)->except('show');

    Route::post('productos/{producto}/variantes', [VarianteController::class, 'store'])->name('productos.variantes.store');
    Route::put('productos/{producto}/variantes/{variante}', [VarianteController::class, 'update'])->name('productos.variantes.update');
    Route::delete('productos/{producto}/variantes/{variante}', [VarianteController::class, 'destroy'])->name('productos.variantes.destroy');

    Route::get('stock', [StockController::class, 'index'])->name('stock.index');
    Route::post('stock', [StockController::class, 'store'])->name('stock.store');
});


