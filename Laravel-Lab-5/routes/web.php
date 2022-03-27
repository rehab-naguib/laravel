<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\OldPostsController ;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController ;

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
    return view('welcome');
});

// Route::get('/posts',[OldPostsController::class,"index"])->name("posts.index");
// Route::post('/posts',[OldPostsController::class,"store"])->name("posts.store");

// Route::get('/posts/add',[OldPostsController::class,"add"])->name("posts.add");

// Route::get("/posts/view/{id}",[OldPostsController::class,"view"])->name("posts.view");

// Route::get('/posts/update/{id}',[OldPostsController::class,"edit"])->name("posts.edit");
// Route::put('/posts/update/{id}',[OldPostsController::class,"update"])->name("posts.update");

// Route::delete('/posts/{id}',[OldPostsController::class,"destroy"])->name("posts.destroy");

// Route::get("/user/posts/view/{user}", [UserController::class,"userPosts"])->name("user.posts");

Route::resource("posts",PostsController::class)->middleware("auth");
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('google',function(){

    Return view('googleAuth');
});
Route::get('auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
