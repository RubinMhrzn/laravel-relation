<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

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
    Route::get('/login', [AdminDashboardController::class, 'showAdminLoginForm'])->name('login');
    Route::post('/login', [AdminDashboardController::class, 'adminLogin'])->name('login.store');
    Route::get('/dashboard', [AdminDashboardController::class, 'adminDashboard'])->middleware('auth:admin')->name('dashboard');
    Route::post('/logout', [AdminDashboardController::class, 'logout'])->name('logout');
});

Route::group(['as' => 'writer.'], function () {
    Route::get('/login', [AuthController::class, 'showLoginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('auth:writer')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/media', [MediaController::class, 'index'])->name('media.index');
Route::post('/media', [MediaController::class, 'store'])->name('media.store');
Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.destroy');

//forget password
Route::get('/forget-password', [AuthController::class, 'forgetPassword'])->name('forget-password');
Route::post('/send-password', [AuthController::class, 'sendPasswordResetToken'])->name('send-password');
Route::get('/set-password', [AuthController::class, 'setPassword'])->name('set-password');
Route::post('/set-password', [AuthController::class, 'resetPassword']);


//change password
Route::get('/changepassword', [AuthController::class, 'changePassword'])->middleware('auth:writer')->name('changepassword');
Route::post('/replacepassword', [AuthController::class, 'replacepassword'])->middleware('auth:writer')->name('replacepassword');

// Route::get('/displayproduct', [ProductController::class, 'displayproduct'])->name('displayproduct');

Route::get('/product-list', [ProductController::class, 'productlist'])->name('productlist');

