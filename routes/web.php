<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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

Route::get('/posts/{id}', [PostController::class, 'show'])->middleware(['auth', 'verified'])->name('single_post');

Route::get('/{id}/posts', [ProfileController::class, 'posts'])->middleware(['auth', 'verified'])->name('my_posts');

Route::delete('/posts/{id}/delete', [PostController::class, 'destroy'])->middleware(['auth', 'verified'])->name('delete_post');


Route::post('/posts/{id}/comment', [CommentController::class, 'store'])->middleware(['auth', 'verified'])->name('comment_store');

Route::delete('/posts/{id}/comment/delete', [CommentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('delete_comment');




require __DIR__.'/auth.php';

