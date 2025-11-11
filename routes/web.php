<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

// Front-end routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/activities', [HomeController::class, 'activities'])->name('activities');
Route::get('/activity/{activity}', [HomeController::class, 'show'])->name('activities.show');
Route::post('/activity/register', [HomeController::class, 'register'])
    ->name('activity.register')
    ->middleware('throttle:5,60');
Route::get('/support', [HomeController::class, 'support'])->name('support');
Route::get('/highlights', [HomeController::class, 'highlights'])->name('highlights');

// Contact form submission (rate limited: 3 submissions per hour per IP)
Route::post('/contact', [ContactController::class, 'submit'])
    ->name('contact.submit')
    ->middleware('throttle:3,60');

// Blog/Posts Routes
Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('posts.show');

// Load authentication routes
require __DIR__.'/auth.php';
