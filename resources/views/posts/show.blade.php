@extends('layout.app')
@section('title',  $post->title )
@include("partials.header",[ "user"=> $user,])

<div class="m-auto px-4 py-8 max-w-xl">

 <div class="px-4 py-8 max-w-xl">
         <div class="bg-white shadow-2xl" >
             <div class="px-4 py-2 mt-2 bg-white" >
                 <img src="{{$post->thumbnail}}">
             </div>
             <div class="px-4 py-2 mt-2 bg-white">
                 <h2 class="font-bold text-2xl text-gray-800">{{$post->title}}</h2>
                 <p class="sm:text-sm text-xs text-gray-700 px-2 mr-1 my-3">
                    {{ $post->description }}
                 </p>

                 <p class="sm:text-sm text-xs text-gray-700 px-2 mr-1 my-3">
                    @if (isset($post->user->name))
                             {{$post->user->name}}

                    @endif
                 </p>
             </div>

             @if ($user->id == $post->user->id || auth()->user()->isAdmin() )

             <div class="px-4 py-2 mt-2 bg-white" >
                <a href="{{route("post.edit",$post->id )}}">Редактирование</a>
            </div>

            <div class="px-4 py-2 mt-2 bg-white" >
                    <form action="{{ route("post.delete" , $post->id ) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input  type="submit" value="Удалить">
                    </form>
            @endif



            </div>

        </div>
  </div>

</div>
