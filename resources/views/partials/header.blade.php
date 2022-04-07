
<nav class="font-sans flex flex-col text-center content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 bg-white shadow sm:items-baseline w-full">
    <div class="mb-2 sm:mb-0 inner">

        <a href="{{ route("home")}}" class="text-2xl no-underline text-grey-darkest hover:text-blue-dark font-sans font-bold">КОТИКИ ОНЛАЙН</a><br>



        @auth("web")
            <span class="text-xs text-grey-dark">Имя пользователя: {{ Auth::user()->name}} </span>
        @endauth
        @guest("web")
            <span class="text-xs text-grey-dark">Гость </span>
        @endguest
    </div>

    <div class="sm:mb-0 self-center">
        @auth("web")
            <a href="{{ route("posts.create") }}" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Создать пост</a>
        @endauth
    </div>


    <div class="sm:mb-0 self-center">
        @if (Auth::check()&& Auth::user()->role == true)
            <a href="{{ route("admin.posts.index") }}" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">adm</a>
        @endif
    </div>

    <div class="sm:mb-0 self-center">
        @auth("web")
            <a href="{{ route("posts.show_user_posts") }}" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Мои посты</a>
        @endauth
    </div>



    <div class="sm:mb-0 self-center">
        @auth("web")
            <a href="{{ route("logout") }}" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Выйти</a>
        @endauth

        @guest("web")
            <a href="{{ route("login") }}" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Войти</a>
        @endguest
    </div>

</nav>
