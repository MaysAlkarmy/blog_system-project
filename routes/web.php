<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\User\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});     // test the routes  --> all its work

Route::get('/test', function () {
    return view('test');
});  
// Admin Routes 

Route::prefix('admin')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('showRegisterForm');
    Route::post('/register', [AuthController::class, 'register'])->name('admin.register');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

     Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
    });
});


// User Routes
Route::prefix('user')->group(function () {
 Route::get('/register', [RegistrationController::class, 'showRegister'])->name('showRegister');
 Route::post('/register', [RegistrationController::class, 'register'])->name('register');

 Route::get('/login', [RegistrationController::class, 'showLogin'])->name('showLogin');
 Route::post('/login', [RegistrationController::class, 'login'])->name('login');
 Route::post('/logout', [RegistrationController::class, 'logout'])->name('logout');

 Route::middleware('auth:web')->group(function () {
        Route::get('dashboard', [RegistrationController::class, 'dashboard'])->name('user.dashboard');
    });

 Route::resource('posts', PostController::class)->middleware('auth');
//Route::get('/showRegister', [RegistrationController::class, 'showRegister'])->name('showRegister');
});


Route::middleware(['auth'])->group(function () {
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

