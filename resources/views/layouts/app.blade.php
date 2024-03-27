<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('posts.index') }}">Posts</a></li>
                    <!-- 추가적인 메뉴 항목을 여기에 배치할 수 있습니다 -->
                </ul>
            </div>
        </nav>
    </header>

    <div class="container" style="max-width: 640px; margin: 0 auto; padding-top: 1rem;">
        @yield('content')
    </div>

</body>
</html>
