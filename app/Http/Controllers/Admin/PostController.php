<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdminPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::all();
        return view('admin.posts.index',[
            "posts"=>$posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdminPost $request)
    {
        // ХОЧУ ВАЛИДАЦИЮ  в ФАЙЛ ФОРМ РЕКВЕСТ - сделано!!
        $data = $request->validated();

        //dump($data);
        //РАБОТАЕТ !!!!!!!!!!!!!!!!!!!!
        $user=auth()->user()->posts()->create($data);
       // dd($user);

       //старое неправильно ! но работает
        /*$post = Post::create([
            "title" => $data["title"],
            "description" => $data["description"],
            "thumbnail" => $data["thumbnail"],

        ]);
*/
        return redirect(route("admin.posts.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        //dd($post);
        return view('admin.posts.edit',[
            "post"=> $post,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
        // валидацию в модели ?
        $data = request()->validate([
            "title" => ["string"],
            "description" => ["string"],
            "thumbnail" => ["string"],
            "user_id" => '',
        ]);
        //dd($data);
        $post->update($data);
        return redirect(route("admin.posts.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect(route("admin.posts.index"));
    }


    public function show($id)
    {

    }


}
