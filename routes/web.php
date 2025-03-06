<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/product', [ProductController::class, 'index'])->name('product');

Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');

Route::post('/product', [ProductController::class, 'store'])->name('product.store');

Route::match(['put', 'patch'], '/product/{id}', [ProductController::class, 'update'])->name('product.update');

Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

// Route::resource('products', ProductController::class);

Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');

