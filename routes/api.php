<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController as UserAuthController;
use App\Http\Controllers\Api\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Api\PostApiController;

// all routes work

Route::prefix('user')->group(function () {
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/login', [UserAuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [UserAuthController::class, 'profile']);
        Route::post('/logout', [UserAuthController::class, 'logout']);
    });
});

Route::prefix('admin')->group(function () {
    Route::post('/register', [AdminAuthController::class, 'register']);
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [AdminAuthController::class, 'profile']);
        Route::post('/logout', [AdminAuthController::class, 'logout']);
    });
});

// Public routes
Route::get('/posts', [PostApiController::class, 'index']);
Route::get('/posts/{post}', [PostApiController::class, 'show']);

// Protected routes (requires login)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/posts', [PostApiController::class, 'store']);
    Route::put('/posts/{post}', [PostApiController::class, 'update']);
    Route::delete('/posts/{post}', [PostApiController::class, 'destroy']);
});