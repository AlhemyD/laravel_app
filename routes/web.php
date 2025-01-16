<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);
Route::post('posts/{post}/publish', [PostController::class, 'publish'])->name('posts.publish');
Route::post('posts/{post}/unpublish', [PostController::class, 'unpublish'])->name('posts.unpublish');
Route::post('posts/{post}/comments', [PostController::class, 'storeComment'])->name('posts.comments.store');

Route::get('comments', [CommentController::class, 'index'])->name('comments.index');
Route::post('comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');
