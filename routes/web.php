<?php

use App\Http\Controllers\admin\AdminAuthorRequestController;
use App\Http\Controllers\admin\AdminPostController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorRequestController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Support\Facades\Route;


// ->middleware(['auth'])->name('dashboard')

Route::get('/',[PostController::class,'index'])->name('posts.index');



Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.store');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::get('/register',[AuthController::class,'showRegister'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('register.store');


Route::middleware(['auth'])->group(function(){
    
    Route::post('/posts',[PostController::class,'store'])->name('posts.store');
    
    Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
    Route::get('/posts/{id}/edit',[PostController::class,'edit'])->name('posts.edit');
    Route::put('/posts/{post}',[PostController::class,'update'])->name('posts.update');
    Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');
    

    Route::get('/bookmarks',[BookmarkController::class,'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{post}',[BookmarkController::class,'bookmarkPost'])->name('bookmarks.store');


    Route::post('/likes/{post}',[LikeController::class,'likePost'])->name('likes.store');


    Route::post('/comments',[CommentController::class,'store'])->name('comments.store');
    Route::delete('/comments/{comment}',[CommentController::class,'destroy'])->name('comments.destroy');


    Route::post('/author_request',[AuthorRequestController::class,'store'])->name('author_request.store');
    Route::get('/author_request/create',[AuthorRequestController::class,'create'])->name('author_request.create');

});

Route::get('/posts/{id}',[PostController::class,'show'])->name('posts.show'); // this round should be stay after post.create 

Route::middleware(['role_id:1'])->group(function(){
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');
    
    Route::get('/admin/posts',[AdminPostController::class,'index'])->name('admin.posts.index');


    Route::get('/users',[UsersController::class,'index'])->name('admin.users.index');

    Route::get('/admin/author_request',[AdminAuthorRequestController::class,'index'])->name('admin.author_request.index');
    Route::put('/admin/author_request/{authorRequest}',[AdminAuthorRequestController::class,'updateRequest'])->name('admin.author_request.update');

    Route::get('/categories',[CategoryController::class,'index'])->name('admin.categories.index');
    Route::post('/categories',[CategoryController::class,'store'])->name('admin.categories.store');
    Route::post('/categories/{category}',[CategoryController::class,'update'])->name('admin.categories.update');


    Route::get('/admin/profile',[ProfileController::class,'index'])->name('admin.profile.index');
    
});
