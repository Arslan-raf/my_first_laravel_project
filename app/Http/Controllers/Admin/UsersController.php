<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show_all()
    {
        $users = User::all();
            return view("admin.users.all",[
                "users"=>$users,
            ]);
    }

    public function posts_show($id)
    {
        $user  = User::findOrFail($id);
        //$posts = $user->posts()->get();
       // $posts = Post::where();
        $posts = Post::where('user_id', $user->id )->get();
        ///dd($posts);
            return view("admin.users.posts",[
                "user"=>$user,
                "posts"=>$posts,
            ]);

    }
// МЯгкое удаление юзеров и постов и восстановаить +
    public function destroy($id){
        $user = User::find($id);
        $user->posts()->delete();
        $user->delete($id);
        return redirect()->route('admin.users');
     }

//посмотреть удаленных пользователей +
     public function show_deleted_users(){
        $users = User::onlyTrashed()->get();
            return view("admin.deleted.users",[
                "users"=>$users,
            ]);

        }

        //восстановление пользоваетля
    public function restore_user($id){

        $user = User::onlyTrashed()->find($id);  // почему findOrFail($id) восстанавливал всех

           $user->restore();

            return redirect()->route('admin.deleted_users');
        }

//удалить пользователя навсегда
        public function permanently_delete($id){
            $user = User::where('id', $id);
            $user->forceDelete(); //удаление пользователя
            return redirect()->route('admin.deleted_users');
        }
 
}
