<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/login', [PageController::class, 'loginForm'])->name('login');
Route::post('/login', [PageController::class, 'login'])->name('login.submit');

Route::get('/register', [PageController::class, 'registerForm'])->name('register');
Route::post('/register', [PageController::class, 'register'])->name('register.submit');

Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/pengelolaan', [PageController::class, 'pengelolaan'])->name('pengelolaan');
Route::get('/profile', [PageController::class, 'profile'])->name('profile');

Route::get('/logout', [PageController::class, 'logout'])->name('logout');
