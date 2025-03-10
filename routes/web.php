<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/product', [ProductController::class, 'index'])->name('product');

Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::get('/product/{slug}/edit', [ProductController::class, 'edit'])->name('product.edit');

Route::post('/product', [ProductController::class, 'store'])->name('product.store');

Route::match(['put', 'patch'], '/product/{id}', [ProductController::class, 'update'])->name('product.update');

Route::delete('/product/{slug}', [ProductController::class, 'destroy'])->name('product.destroy');

// Route::resource('products', ProductController::class);

Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/login', [AdminController::class, 'showAdminLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'adminLogin']);
    Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('dashboard')->middleware(['auth:admin']);
});

Route::group(['as' => 'writer.'], function () {
    Route::get('/login', [AuthController::class, 'showWriterLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'writerLogin']);
    Route::get('/dashboard', [DashboardController::class, 'writerDashboard'])->name('dashboard')->middleware(['auth:writer']);
});
