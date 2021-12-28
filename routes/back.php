<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\LoginController;

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'handleLogin'])->name('handleLogin');