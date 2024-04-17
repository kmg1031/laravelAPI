<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Laravel App</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
        />
</head>
<body>
    <header>
        <nav>
            <div class="container" style="max-width: 640px; margin: 0 auto;">
                <a href="#" style="font-size: 1.5em;">My Laravel App</a>
                <ul>
                    {{-- 공통 --}}
                    <li><a href="{{ url('/') }}">Home</a></li>
                    {{-- 게스트 --}}
                    @guest
                        <li><a href="{{ route('login.index') }}">로그인</a></li>
                    @endguest
                    {{-- 인증 유저 --}}
                    @auth
                        <li><a href="{{ route('logout') }}">로그아웃</a></li>
                        <li><a href="{{ route('posts.index') }}">게시글</a></li>
                    @endauth
                </ul>
            </div>
        </nav>
    </header>

    <div class="container" style="max-width: 640px; margin: 0 auto; padding-top: 1rem;">
        @yield('content')
    </div>

</body>
</html>
