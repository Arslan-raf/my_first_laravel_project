<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\UserCanСhangePost;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');


Route::middleware("auth:web")->group(function () {
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/posts/{id}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

    Route::get('/post/create', [PostController::class, "create"])->name("posts.create") ;
    Route::post('/posts/create_process', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.create_process');

    Route::get('/post/show_user_posts', [PostController::class, "show_user_posts"])->name("posts.show_user_posts") ;


    Route::middleware(UserCanСhangePost::class)->group(function () {
            ///РЕдактирование
    Route::get('/posts/{post}/edit',[PostController::class ,'edit'])->name('post.edit');
    Route::post('posts/{post}',[PostController::class ,'update' ])->name('post.update');//+

    });


    Route::delete('/post/{id}', [PostController::class,'destroy'])->name('post.delete');



});


Route::middleware("guest:web")->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login_process', [\App\Http\Controllers\AuthController::class, 'login'])->name('login_process');

    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_process', [\App\Http\Controllers\AuthController::class, 'register'])->name('register_process');

});
