<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\BlogController;

Route::get('/', [BlogController::class, 'index'])->name('blog.index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::resources([
    'posts' => PostController::class
]);
