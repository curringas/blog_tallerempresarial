<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Models\User;
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

Route::resource('post', PostController::class)->names('posts')->parameter('post','id')->middleware('auth');
/* Esto es lo mismo que la linea anterior
se usa siempre la ruta con 'post' pero con el name 'posts' y el parametro 'id' en lugar de 'post'
si no se definie arriva names y parameter pues se usa por defecto 'post' que es el nombre del recurso 
Route::middleware('auth')->group(function () {
    Route::get('/post', [PostController::class, 'index'])->name('posts.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/post/store', [PostController::class, 'store'])->name('posts.store'); // Save
    Route::put('/post/{id}', [PostController::class, 'update'])->name('posts.update'); // Update
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});*/

require __DIR__.'/auth.php';
