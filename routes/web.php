<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}); 
// ->middleware(['auth'])->name('dashboard')

Route::get('/auth/login',function(){
    return view('auth.login');
});


Route::get('/posts',[PostController::class,'index'])->name('posts.index');
Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
Route::post('/posts',[PostController::class,'store'])->name('posts.store');
Route::get('/posts/{id}',[PostController::class,'show'])->name('posts.show');
Route::get('/posts/{id}/edit',[PostController::class,'edit'])->name('posts.edit');
Route::put('/posts/{post}',[PostController::class,'update'])->name('posts.update');
Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');


Route::get('/bookmarks',[BookmarkController::class,'index'])->name('bookmarks.index');
Route::post('/bookmark/{post}',[BookmarkController::class,'bookmarkPost'])->name('bookmark.store');

