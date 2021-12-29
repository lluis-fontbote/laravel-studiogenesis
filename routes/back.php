<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\LoginController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\ProductController;

Route::middleware(['throttle:login'])->group(function() {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'handleLogin'])->name('handleLogin');
});

Route::middleware('auth')->name('back.')->group(function() {
    Route::get('/usuarios', [UserController::class, 'index'])->name('user.index');
    Route::get('/usuarios/crear', [UserController::class, 'create'])->name('user.create');
    Route::post('/usuarios/insertar', [UserController::class, 'store'])->name('user.store');
    Route::get('/usuarios/editar/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/usuarios/actualizar', [UserController::class, 'update'])->name('user.update');
    Route::get('/usuarios/eliminar/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/categorias', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categorias/crear', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categorias/insertar', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categorias/editar/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/categorias/actualizar', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/categorias/eliminar/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/productos', [ProductController::class, 'index'])->name('product.index');
    Route::get('/productos/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/productos/crear', [ProductController::class, 'create'])->name('product.create');
    Route::post('/productos/insertar', [ProductController::class, 'store'])->name('product.store');
    Route::get('/productos/editar/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/productos/actualizar', [ProductController::class, 'update'])->name('product.update');
    Route::get('/productos/eliminar/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});
