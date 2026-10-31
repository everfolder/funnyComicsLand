<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\PageController::class, 'welcome'])->name('welcome');

Route::get('/registration', [\App\Http\Controllers\PageController::class, 'registration'])->name('registration');
Route::post('/register', [\App\Http\Controllers\UserController::class, 'register'])->name('register');

Route::get('/auth', [\App\Http\Controllers\PageController::class, 'auth'])->name('auth');
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login');

Route::get('/login', [\App\Http\Controllers\PageController::class, 'admin_index'])->name('admin.index');
