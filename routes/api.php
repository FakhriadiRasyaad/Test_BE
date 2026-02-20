<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CourseController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public course catalog
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Admin only routes
    Route::middleware('is_admin')->group(function () {
        // Topics
        Route::post('/topics', [TopicController::class, 'store']);
        Route::put('/topics/{id}', [TopicController::class, 'update']);
        Route::delete('/topics/{id}', [TopicController::class, 'destroy']);

        // Languages
        Route::post('/languages', [LanguageController::class, 'store']);
        Route::put('/languages/{id}', [LanguageController::class, 'update']);
        Route::delete('/languages/{id}', [LanguageController::class, 'destroy']);

        // Courses CRUD (admin)
        Route::post('/courses', [CourseController::class, 'store']);
        Route::put('/courses/{id}', [CourseController::class, 'update']);
        Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

        // Topics & Languages read (admin)
        Route::get('/topics', [TopicController::class, 'index']);
        Route::get('/topics/{id}', [TopicController::class, 'show']);
        Route::get('/languages', [LanguageController::class, 'index']);
        Route::get('/languages/{id}', [LanguageController::class, 'show']);
    });
});