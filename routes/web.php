<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\BlogController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resources([
    'posts' => PostController::class
]);










Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('registerForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
Route::patch('/profile', [AuthController::class, 'updateProfile'])->name('updateProfile');
Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('changePasswordForm');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('changePassword');