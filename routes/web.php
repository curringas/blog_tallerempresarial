<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/post/create', [PostController::class, 'edit'])->name('posts.create');
    Route::get('/post/{post}', [PostController::class, 'show'])->name('posts.view');
    Route::get('/post/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/post/save', [PostController::class, 'save'])->name('posts.save');
    Route::post('/post/update', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

require __DIR__.'/auth.php';
