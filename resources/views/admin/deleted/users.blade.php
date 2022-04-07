@extends('layout.admin')
@section('title','Удаленные пользователи')
@section('content')


<div class="container mx-auto px-6 py-8">
    <h3 class="text-gray-700 text-3xl font-medium">Удаленные ользователи</h3>

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
                            ID Пользователя</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                               Имя пользователя</th>
                               <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Email пользователя</th>
                               <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Удалить на веки вечные</th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Восстать из мертвых</th>

                    </tr>
                    </thead>

                    <tbody class="bg-white">
                        @foreach ( $users as $user)

                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">{{ $user->id}}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">{{ $user->name}}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">{{ $user->email}}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                <form action="{{ route("admin.permanently_delete" , $user->id ) }}" method="POST">
                                    @csrf

                                    <input  type="submit" value="Удалить навсегда">
                                </form>

                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                <form action="{{ route("admin.restore_user" , $user->id ) }}" method="POST">
                                    @csrf

                                    <input  type="submit" value="Восстановить пользователя">
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
