<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}); 
// ->middleware(['auth'])->name('dashboard')


Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.post');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware(['auth'])->group(function(){


    Route::get('/posts',[PostController::class,'index'])->name('posts.index');
    Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
    Route::post('/posts',[PostController::class,'store'])->name('posts.store');
    Route::get('/posts/{id}',[PostController::class,'show'])->name('posts.show');
    Route::get('/posts/{id}/edit',[PostController::class,'edit'])->name('posts.edit');
    Route::put('/posts/{post}',[PostController::class,'update'])->name('posts.update');
    Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');


    Route::get('/bookmarks',[BookmarkController::class,'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{post}',[BookmarkController::class,'bookmarkPost'])->name('bookmarks.store');


    Route::post('/likes/{post}',[LikeController::class,'likePost'])->name('likes.store');


    Route::post('/comments',[CommentController::class,'store'])->name('comments.store');
    Route::delete('/comments/{comment}',[CommentController::class,'destroy'])->name('comments.destroy');


});

Route::middleware(['role_id:1'])->group(function(){
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard');
});
