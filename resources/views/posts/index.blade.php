{{-- 게시글 목록 페이지 --}}
@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 640px; margin: 0 auto;">
    <h1>게시글 목록</h1>
    <a href="{{ route('posts.create') }}">새 게시글 작성</a>

    <table class="pico-table">
        <thead>
            <tr>
                <th>제목</th>
                <th>내용</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
            @if($posts->isEmpty())
                <tr>
                    <td colspan="4">게시글이 없습니다.</td>
                </tr>
            @else
                @foreach ($posts as $post)
                    <tr>
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}">
                                {{ $post->title }}
                            </a>
                        </td>
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->user_name }}</td>
                        <td>{{ $post->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
