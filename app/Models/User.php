<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    //ДОБАВИЛ СТРОКУ КОДА
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    use SoftDeletes;
    protected $softDelete = true;

    const ADMIN = 1;
    const USER = 0;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
        // 'role' ?????????????????????????????????????
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function posts_withTrashed() {
        return $this->hasMany(Post::class)->withTrashed();
    }

    public function restore() {
        parent::restore(); //обращ к старому

       // можно обращ чтобы получать данные иили с () чтобы получ запрос
        //dd($posts);
        foreach($this->posts_withTrashed as $post)
        {
            $post->restore();
        }
    }

    public function forceDelete()
    {
        parent::forceDelete();//обращ к старому

        $posts = $this->posts_withTrashed; // можно обращ чтобы получать данные иили с () чтобы получ запрос
        //dd($posts);
        foreach($posts as $post)
        {
            $post->forceDelete();
        }
    }

    public function post_create($data){

        $this->posts()->create([
            "title" => $data["title"],
            "description" => $data["description"],
            "thumbnail" => $data["thumbnail"],
            ]);
    }

    /* проверка на админа (в мидлвере) */
    public function isAdmin(){
        $user = Auth::user();
       if ($user->role == self::ADMIN){
            return 1;
       }

    }



}
