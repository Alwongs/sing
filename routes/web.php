<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PollinationsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\ImageCleanupController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProjectController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pollinations', [PollinationsController::class, 'index'])->name('pollinations');
    Route::post('/ajax/text', [PollinationsController::class, 'handleText'])->name('ajax.text'); 
    
    Route::get('/posts/create/{category}', [PostController::class, 'createCategoryPost'])->name('posts.create.with-category');    

    Route::resources([
        'posts'      => PostController::class,
        'categories' => CategoryController::class
    ]);

    Route::get('/admin/cleanup-images', [ImageCleanupController::class, 'show'])->name('admin.cleanup.images');
    Route::post('/admin/cleanup-images/delete', [ImageCleanupController::class, 'delete'])->name('admin.cleanup.images.delete');

    Route::get('/admin/settings', [SettingsController::class, 'index'])->name('admin.settings');


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::patch('/profile', [AuthController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('changePasswordForm');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('changePassword');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('registerForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
