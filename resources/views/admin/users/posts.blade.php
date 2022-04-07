@extends('layout.admin')
@section('title','Пользователь')
@section('content')

<div class="container mx-auto px-6 py-8">
    <h3 class="text-gray-700 text-3xl font-medium">Посты пользователя: {{ $user->name  }}</h3>

    <div class="mt-8">

    </div>

    <div class="flex flex-col mt-8">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            ID поста</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                               Заголовок поста</th>
                               <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Действия</th>

                    </tr>
                    </thead>

                    <tbody class="bg-white">
                        @foreach ( $posts as $post)

                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">{{ $post->id}}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                {{-- <div class="text-sm leading-5 text-gray-900">{{ $post->title}}</div> --}}
                                <a href="{{ route('posts.show',$post->id) }}">{{ $post->title}}</a>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                               <a href="{{ route('admin.posts.edit', $post->id ) }}">Редактирование</a>
                               <form action="{{ route('admin.posts.destroy',$post->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="DELETE" >
                               </form>
                            </td>

                        </tr>

                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>







@endsection
