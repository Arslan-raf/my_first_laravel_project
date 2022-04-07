<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\UserIsAdmin;
//use App\Models\AdminUser;
use Illuminate\Support\Facades\Route;

/*
Route::middleware('admin')
->prefix('admin')
->name('admin.') - задает начало имент роутов
->namespace($this->namespace)
->group(base_path('routes/admin.php'));
 */

Route::middleware(UserIsAdmin::class)->group(function () {


    Route::resource('posts',AdminPostController::class )->except('update');
    Route::post("posts/create_process",[AdminPostController::class,"store"])->name("posts.create_process");


    //Редактирование  ИСПРАПВИТЬ  ДУБЛИКАТЫ
    //Route::get('/posts/{id}/edit',[AdminPostController::class ,'edit'])->name('post.edit');
    Route::post('/posts/{post}',[AdminPostController::class ,'update' ])->name('posts.update');

    // Форма где показываю всех пользователей
    Route::get("all_users",[UsersController::class, "show_all"])->name("users");
    // Форма где показываю всех посты пользователя
    Route::get('/user/{id}', [UsersController::class, 'posts_show'])->name('user.posts.show');

    //Удаление юзера
    Route::delete('/user_delete/{id}', [UsersController::class,'destroy'])->name('user.delete');

    Route::get("all_deleted_users",[UsersController::class, "show_deleted_users"])->name("deleted_users");// показать всех удаленных пользователей
    Route::post('restore_user/{id}',[UsersController::class ,'restore_user' ])->name('restore_user'); // восстановить пользователя
    Route::post('permanently_delete/{id}',[UsersController::class ,'permanently_delete' ])->name('permanently_delete'); //удалить навсегда


    //Авторизация под юзера
    Route::post('login_under_user/{id}',[AuthController::class ,'login_under_user' ])->name('login_under_user'); //

});







//разлогин  НЕ НАДО
   // Route::get("logout",[AuthController::class,"logout"])->name("logout");



