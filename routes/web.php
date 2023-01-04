<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/posts');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// POSTS

Route::get('/posts', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('posts');

Route::get('/posts/create', [PostController::class, 'create'])->middleware(['auth', 'verified'])->name('post_create');

Route::post('/posts', [PostController::class, 'store'])->middleware(['auth', 'verified'])->name('post_store');

Route::get('/posts/{id}', [PostController::class, 'show'])->middleware(['auth', 'verified']);

Route::get('/{id}/posts', [ProfileController::class, 'posts'])->middleware(['auth', 'verified'])->name('my_posts');


Route::view('create-post', 'livewire.home');




require __DIR__.'/auth.php';

