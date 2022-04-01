<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPostController;
use Illuminate\Support\Facades\Route;

// todo: new branch( "UP" ) + merge | user edit (image + password + username)

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('post.show');

Route::post('posts/{post}/like', [PostController::class, 'like']);
Route::post('posts/{post}/dislike', [PostController::class, 'dislike']);

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::post('newsletter', NewsletterController::class);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::middleware('guest')->prefix('loginn')->group(function () {
    Route::get('', [SessionsController::class, 'create']);
    Route::post('', [SessionsController::class, 'store']);
});

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::get('user/{user}/posts', [UserPostController::class, 'index'])->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::resource('user/posts', UserPostController::class)->except('show', 'index');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin/posts', AdminPostController::class)->except('show');
});

Route::get('user/{user}/edit', [UserController::class, 'index'])->middleware('auth');
Route::put('user/{user}/update', [UserController::class, 'update'])->middleware('auth');
