<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthController extends Controller
{

    // НЕ НУЖНО
// public function index(){
//     return view("admin.auth.login");
// }

// public function login(Request $request){
//     $data = $request->validate([
//         "email" => ["required", "email", "string"],
//         "password" => ["required"]
//     ]);

//     if(auth("admin")->attempt($data)) {
//         return redirect(route("admin.posts.index"));
//     }
//     return redirect(route("admin.login"))->withErrors(["email" => "Пользователь не найден, либо данные введены не правильно"]);
// }

// public function logout()
// {
//     auth("admin")->logout();

//     return redirect(route("home"));
// }


public function login_under_user($id)
{

        Auth::loginUsingId($id);
        return redirect(route("home"));

}

}
