@extends('layout.app')
@section('title', "Создание поста")
@include("partials.header",[ "user"=> $user])

    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Создание нового поста</h3>
        <div class="mt-8">
        </div>

        <div class="mt-8">

            <form enctype="multipart/form-data" action="{{ route("posts.create_process") }}" method="POST"   class="space-y-5 mt-5">
                @csrf
                <input  name = "title" type="text" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Название" />

                <input  name = "description"  type="text" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Описание" />

                <div>
                    <img  class="h-64 w-64" src="">
                </div>

               <input  name = "thumbnail"  type="text" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="пока временно картинка" />


                <input  type="file" class="w-full h-12" placeholder="Обложка" />

               <!--  <input  name = "user_id"  value="{$user->id}} " type="hidden" > -->

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Создать</button>
            </form>

        </div>
    </div>

