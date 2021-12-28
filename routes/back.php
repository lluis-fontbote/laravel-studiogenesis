<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\LoginController;

Route::get('/login', [LoginController::class, 'login'])->name('login');
// Route::group(['middleware' => ['back']], function () {
// });