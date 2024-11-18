<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function(){

    Route::controller(UsersController::class)->group(function(){
        Route::get('{user:username}','index')->name('userProfile');
        Route::get('{user:username}/edit','edit')->name('editProfile');
        Route::patch('{user:username}/update','update')->name('updateProfile');
        Route::get('{user:username}/follow','follow')->name('followUser');
        Route::get('{user:username}/unfollow','unfollow')->name('unfollowUser');
    });
    
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
    
    Route::get('post/{post:slug}/like',LikesController::class,)->name('likePost');

});

Route::get('explore',[PostController::class,'explore'])->name('explore');

