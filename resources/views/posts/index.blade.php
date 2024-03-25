{{-- 게시글 목록 페이지 --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>게시글 목록</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">새 게시글 작성</a>

    <ul class="list-group mt-4">
        @foreach ($posts as $post)
            <li class="list-group-item">
                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
