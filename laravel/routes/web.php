<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ColasController; 

Route::get('/', [HomeController::class, 'home_index']);

Route::get('/colas', [ColasController::class, 'colas_index'])->name('colas_index');

Route::get('/colas/enviar', [ColasController::class, 'colas_enviar'])->name('colas_enviar');
Route::post('/colas/enviar', [ColasController::class, 'colas_enviar_post'])->name('colas_enviar_post');