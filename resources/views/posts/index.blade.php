{{-- 게시글 목록 페이지 --}}
@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 640px; margin: 0 auto;">
    <h1>게시글 목록</h1>
    <a href="{{ route('posts.create') }}">새 게시글 작성</a>

    <ul>
        @foreach ($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
