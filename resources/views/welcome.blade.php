@extends('layout.app')
@section('title','Привет')
@section('content')
@include("partials.header",["user"=> $user])

 
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-10 mb-20">

           @foreach ( $posts as $post  )
        <div class="px-4 py-8 max-w-xl">
                <div class="bg-white shadow-2xl" >
                    <div>
                        <a href="{{ route("posts.show", $post->id) }}">
                            <img src="{{ $post->thumbnail }}">
                        </a>
                    </div>
                    <div class="px-4 py-2 mt-2 bg-white">
                        <h2 class="font-bold text-2xl text-gray-800">{{$post->title}}</h2>
                        <p class="sm:text-sm text-xs text-gray-700 px-2 mr-1 my-3">
                            {{ $post->description }}
                        </p>

                        <p class="sm:text-sm text-xs text-gray-700 px-2 mr-1 my-3">
                          @if ( isset( $post->user->name ))
                                Пользователь: {{ $post->user->name }}
                            @else Админ
                          @endif

                        </p>
                    </div>
                </div>
         </div>
         @endforeach
    </div>

    {{ $posts->links() }}
@endsection
