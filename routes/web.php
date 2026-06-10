<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PreregistrationController;
use App\Http\Controllers\ResearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.detail');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('course.detail');
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('service.detail');
Route::get('/research', [ResearchController::class, 'index'])->name('research');
Route::get('/preregistration', [PreregistrationController::class, 'index'])->name('preregistration');
Route::post('/preregistration', [PreregistrationController::class, 'store'])->name('preregistration.store');
Route::get('/preregistration/success', [PreregistrationController::class, 'success'])->name('preregistration.success');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Static pages
Route::get('/privacy', function() { return view('privacy'); })->name('privacy');
Route::get('/terms', function() { return view('terms'); })->name('terms');

// Admin routes (protected)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', function() { return view('admin.dashboard'); })->name('admin.dashboard');
});

// Faculty routes (protected)
Route::middleware(['auth', 'role:faculty'])->prefix('faculty')->group(function () {
    Route::get('/', function() { return view('faculty.dashboard'); })->name('faculty.dashboard');
});

// Student routes (protected)
Route::middleware(['auth', 'role:student'])->prefix('students')->group(function () {
    Route::get('/', function() { return view('students.dashboard'); })->name('students.dashboard');
});

// Department Head routes (protected)
Route::middleware(['auth', 'role:head'])->prefix('heads')->group(function () {
    Route::get('/', function() { return view('heads.dashboard'); })->name('heads.dashboard');
});

// Content Creator routes (protected)
Route::middleware(['auth', 'role:content_creator'])->prefix('content-creator')->group(function () {
    Route::get('/', function() { return view('content-creator.dashboard'); })->name('content-creator.dashboard');
});

// Social Media Manager routes (protected)
Route::middleware(['auth', 'role:social_media_manager'])->prefix('social-media')->group(function () {
    Route::get('/', function() { return view('social-media.dashboard'); })->name('social-media.dashboard');
});
