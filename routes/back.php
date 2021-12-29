<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\LoginController;

Route::middleware(['throttle:login'])->group(function() {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'handleLogin'])->name('handleLogin');
});

Route::middleware('auth')->group(function() {
    Route::get('/prova', function() {
        dd('hola');
    });
});
