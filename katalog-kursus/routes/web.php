<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\WebCourseController;
use App\Http\Controllers\AdminController;

// Public routes
Route::get('/', [WebCourseController::class, 'index']);
Route::get('/courses/{id}', [WebCourseController::class, 'show']);

// Auth routes
Route::get('/login', [WebAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [WebAuthController::class, 'login']);
Route::get('/register', [WebAuthController::class, 'showRegister']);
Route::post('/register', [WebAuthController::class, 'register']);
Route::get('/logout', [WebAuthController::class, 'logout']);

// Admin routes
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);

    // Topics
    Route::get('/topics', [AdminController::class, 'topics']);
    Route::post('/topics', [AdminController::class, 'storeTopic']);
    Route::post('/topics/{id}/update', [AdminController::class, 'updateTopic']);
    Route::get('/topics/{id}/delete', [AdminController::class, 'destroyTopic']);

    // Languages
    Route::get('/languages', [AdminController::class, 'languages']);
    Route::post('/languages', [AdminController::class, 'storeLanguage']);
    Route::post('/languages/{id}/update', [AdminController::class, 'updateLanguage']);
    Route::get('/languages/{id}/delete', [AdminController::class, 'destroyLanguage']);

    // Courses
    Route::get('/courses', [AdminController::class, 'courses']);
    Route::post('/courses', [AdminController::class, 'storeCourse']);
    Route::post('/courses/{id}/update', [AdminController::class, 'updateCourse']);
    Route::get('/courses/{id}/delete', [AdminController::class, 'destroyCourse']);
});