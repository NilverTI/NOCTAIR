<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogoController;

Route::get('/', function () {
    return view('landing.index');
})->name('home');

Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo');
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo');