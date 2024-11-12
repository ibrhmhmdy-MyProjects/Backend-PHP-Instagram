<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('post/create', [PostController::class,'create'])->name('createPost')->middleware('auth');
Route::post('post/store', [PostController::class,'store'])->name('storePost')->middleware('auth');
Route::get('post/{post:slug}/show', [PostController::class,'show'])->name('showPost')->middleware('auth');
Route::post('post/{post:slug}/comment', [CommentController::class,'store'])->name('storeComment')->middleware('auth');
Route::get('post/{post:slug}/edit', [PostController::class,'edit'])->name('editPost')->middleware('auth');
Route::patch('post/{post:slug}/update', [PostController::class,'update'])->name('updatePost')->middleware('auth');
Route::delete('post/{post:slug}/delete', [PostController::class,'destroy'])->name('deletePost')->middleware('auth');

require __DIR__.'/auth.php';