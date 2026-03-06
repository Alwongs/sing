<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\PollinationsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\FileManageController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LikeController;

// Route::get('/test', function () { return view('_layouts.test'); });


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/category/{category}', [BlogController::class, 'showCategory'])->name('category');
    Route::get('/search', [BlogController::class, 'search'])->name('search');
    Route::get('/post/{post}', [BlogController::class, 'showPost'])->name('post'); 
    Route::get('/avatar/{imageName}', [UserController::class, 'showAvatarByImageName'])->name('avatar.show');

    // move to BlogController
    Route::post('/post/{post}/comments', [CommentController::class,'store'])->name('comments.store'); 
    
    Route::post('/{post}/like', [LikeController::class, 'toggle'])->name('like.toggle');    
});
Route::prefix('projects')->name('projects.')->group(function () {
    Route::get('/projects', [ProjectController::class, 'index'])->name('index');
});


Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/pollinations', [PollinationsController::class, 'index'])->name('pollinations');
        Route::post('/ajax/text', [PollinationsController::class, 'handleText'])->name('ajax.text'); 
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::get('/settings/file-manage', [FileManageController::class, 'index'])->name('settings.file-manage');
        Route::delete('/settings/delete-unused-images', [FileManageController::class, 'deleteUnusedImages'])->name('settings.delete-unused-images');  
        Route::get('/posts/create/{category}', [PostController::class, 'createCategoryPost'])->name('posts.create.with-category');    
        Route::get('/avatar/{id}', [UserController::class, 'showAvatar'])->name('avatar.show');                  
    });

    Route::resources([
        'users'      => UserController::class,
        'posts'      => PostController::class,
        'categories' => CategoryController::class,
        'comments'   => AdminCommentController::class
    ]);  

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

