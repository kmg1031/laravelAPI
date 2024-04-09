{{-- 개별 게시글 보기 페이지 --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">목록으로 돌아가기</a>
</div>
@endsection
