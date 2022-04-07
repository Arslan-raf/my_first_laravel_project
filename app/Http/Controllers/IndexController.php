<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class IndexController extends Controller
{
    public function index()
    {
        $user = auth()->user(); //зареганый пользователь

        $posts = Post::orderBy("created_at", "DESC")->paginate(3);
        return view('welcome', [
            "posts" => $posts,
            "user"=> $user,
        ]);
    }
}
