<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('{user:username}',[UsersController::class,'index'])->middleware('auth')->name('userProfile');
Route::get('{user:username}/edit',[UsersController::class,'edit'])->middleware('auth')->name('editProfile');
Route::patch('{user:username}/update',[UsersController::class,'update'])->middleware('auth')->name('updateProfile');

Route::middleware('auth')->group(function(){
    Route::controller(PostController::class)->group(function(){
        Route::get('/','index')->name('home');
        Route::get('post/create', 'create')->name('createPost');
        Route::post('post/store', 'store')->name('storePost');
        Route::get('post/{post:slug}/show', 'show')->name('showPost');
        Route::get('post/{post:slug}/edit', 'edit')->name('editPost');
        Route::patch('post/{post:slug}/update', 'update')->name('updatePost');
        Route::delete('post/{post:slug}/delete', 'destroy')->name('deletePost');
    });
    Route::post('post/{post:slug}/comment', [CommentController::class,'store'])->name('storeComment');
});
Route::get('explore',[PostController::class,'explore'])->name('explore');
Route::get('post/{post:slug}/like',LikesController::class)->middleware('auth')->name('likePost');

