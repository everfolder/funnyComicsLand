<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\PageController::class, 'welcome'])->name('welcome');

Route::get('/registration', [\App\Http\Controllers\PageController::class, 'registration'])->name('registration');
Route::post('/register', [\App\Http\Controllers\UserController::class, 'register'])->name('register');

Route::get('/auth', [\App\Http\Controllers\PageController::class, 'auth'])->name('auth');
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::post('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');

Route::get('/admin', [\App\Http\Controllers\PageController::class, 'admin_index'])->name('admin.index');

Route::post('/product/create', [\App\Http\Controllers\ProductController::class, 'create'])->name('product.create');

Route::post('/category/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');

Route::get('/about', [\App\Http\Controllers\PageController::class, 'about'])->name('about');
Route::get('/catalog', [\App\Http\Controllers\PageController::class, 'catalog'])->name('catalog');
Route::get('/where', [\App\Http\Controllers\PageController::class, 'where'])->name('where');
Route::get('/cart', [\App\Http\Controllers\PageController::class, 'cart'])->name('cart');
