<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function(){
    Route::controller(ProfileController::class)->group(function (){
        Route::get('/profile','edit')->name('profile.edit');
        Route::patch('/profile','update')->name('profile.update');
        Route::delete('/profile','destroy')->name('profile.destroy');
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
});


require __DIR__.'/auth.php';