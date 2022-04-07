<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function create()
    {
        $user = auth()->user();
        return view("posts.create", ["user"=> $user,]);
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => ["string"],
            "description" => ["string"],
            "thumbnail" => ["string"],
            "user_id" => '',
        ]);

// НАДО
// РаБОТАЕТ       111111111111111111111111111111111111111111111111111111111111
$user=auth()->user()->post_create($data);

        /*$user_id = auth()->user()->posts()->create([
        "title" => $data["title"],
        "description" => $data["description"],
        "thumbnail" => $data["thumbnail"],
        ]);*/

        /*$user_id = auth()->user()->id;

        $post = Post::create([
            "title" => $data["title"],
            "description" => $data["description"],
            "thumbnail" => $data["thumbnail"],
            "user_id"=> $user_id,
        ]);*/

        return redirect(route("home"));
    }



    public function show($id)
    {
        $post = Post::findOrFail($id);
        $user = auth()->user();
        return view('posts.show', [
            "post" => $post,
            "user" => $user,
        ]);
    }


    public function edit($id)
    {

        $post = Post::find($id);
        //$post = Post::where('id', $id)->first();
       // $post = Post::find($id);
        // dump($user->id);
        // dump($post);
        // dd($post->user_id);

    // мидлвер есть для проверки
            return view('posts.edit',[
                "post"=> $post,

            ]);

    }


    public function update(Post $post){
        //$user_id = auth()->user()->id;
//  dd($post);
        $data = request()->validate([
            'title'=>'string',
            "description"=>'string',
            "thumbnail"=>'string',
            "user_id"=>'',  //* */
        ]);

// dump($post);
        $post->update($data);
      //dd( $post);
       return redirect(route('posts.show', ['id'=> $post->id]));

    }


    public function destroy($id){

        $user = auth()->user();
        $post = Post::where('id', $id)->first();//  и получу его юзер_ид

        if($user->id == $post->user_id || $user->role == true){
            Post::destroy($id);
            return redirect()->route('home');
        }
        else {
            echo("Удалять нельзя!");
        }

    }


 public function show_user_posts()
 {
     $user = auth()->user();
    $posts = Post::where('user_id',$user->id)->get();
    return view("posts.show_user_posts",[
        "user"=> $user,
        "posts"=> $posts,
    ]);

 }



}
