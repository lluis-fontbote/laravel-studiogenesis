<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\LoginController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Back\ParentCategoryController;
use App\Http\Controllers\Back\ChildCategoryController;
use App\Http\Controllers\Back\ProductController;

Route::middleware(['throttle:login'])->group(function() {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'handleLogin'])->name('handleLogin');
});

Route::middleware('auth')->name('back.')->group(function() {
    Route::middleware('admin')->group(function() {
        Route::get('/usuarios', [UserController::class, 'index'])->name('user.index');
        Route::get('/usuarios/crear', [UserController::class, 'create'])->name('user.create');
        Route::post('/usuarios/insertar', [UserController::class, 'store'])->name('user.store');
        Route::get('/usuarios/editar/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/usuarios/actualizar', [UserController::class, 'update'])->name('user.update');
        Route::get('/usuarios/eliminar/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::get('/categorias-padres', [ParentCategoryController::class, 'index'])->name('parentCategory.index');
    Route::get('/categorias-padres/crear', [ParentCategoryController::class, 'create'])->name('parentCategory.create');
    Route::post('/categorias-padres/insertar', [ParentCategoryController::class, 'store'])->name('parentCategory.store');
    Route::get('/categorias-padres/editar/{id}', [ParentCategoryController::class, 'edit'])->name('parentCategory.edit');
    Route::post('/categorias-padres/actualizar', [ParentCategoryController::class, 'update'])->name('parentCategory.update');
    Route::get('/categorias-padres/eliminar/{id}', [ParentCategoryController::class, 'destroy'])->name('parentCategory.destroy');
    Route::get('/categorias-padres/filtrar', [ParentCategoryController::class, 'filter'])->name('parentCategory.filter');
    Route::get('/categorias-padres/eliminar-confirmado/{id?}', [ParentCategoryController::class, 'confirmDestruction'])->name('parentCategory.confirmDestruction');
    Route::get('/categorias-padres/eliminar-con-hijos/{id?}', [ParentCategoryController::class, 'destroyWithChildren'])->name('parentCategory.destroyWithChildren');

    Route::get('/categorias-hijas', [ChildCategoryController::class, 'index'])->name('childCategory.index');
    Route::get('/categorias-hijas/crear', [ChildCategoryController::class, 'create'])->name('childCategory.create');
    Route::post('/categorias-hijas/insertar', [ChildCategoryController::class, 'store'])->name('childCategory.store');
    Route::get('/categorias-hijas/editar/{id}', [ChildCategoryController::class, 'edit'])->name('childCategory.edit');
    Route::post('/categorias-hijas/actualizar', [ChildCategoryController::class, 'update'])->name('childCategory.update');
    Route::get('/categorias-hijas/eliminar/{id}', [ChildCategoryController::class, 'destroy'])->name('childCategory.destroy');
    Route::get('/categorias-hijas/filtrar', [ChildCategoryController::class, 'filter'])->name('childCategory.filter');

    Route::get('/productos', [ProductController::class, 'index'])->name('product.index');
    Route::get('/productos/crear', [ProductController::class, 'create'])->name('product.create');
    // Route::get('/productos/ver/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::post('/productos/insertar', [ProductController::class, 'store'])->name('product.store');
    Route::get('/productos/editar/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/productos/actualizar', [ProductController::class, 'update'])->name('product.update');
    Route::get('/productos/eliminar/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

Route::get('/denegado', function() {
    return view('errors.401');
})->name('denied');