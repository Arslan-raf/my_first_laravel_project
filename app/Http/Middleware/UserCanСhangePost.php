<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
class UserCanСhangePost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $user = Auth::user();

 //dd($request->post);
        if(isset($request->post->id)){ //Post
            $post= $request->post;
        }
        else{
           $post = Post::find($request->post);//get
        }



        if($user->id == $post->user_id || $user->role == true ){  //метод проверки isAdmin
           //dd("могу");
            return $next($request);
         }
         dd("не могу");
    }
}
