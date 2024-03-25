<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 게시글 목록을 보여주는 메서드
    public function index()
    {
        $posts = Post::all(); // 모든 게시글을 조회
        return view('posts.index', compact('posts'));
    }

    // 게시글 생성 폼을 보여주는 메서드
    public function create()
    {
        return view('posts.create');
    }

    // 새 게시글을 저장하는 메서드
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index')
                         ->with('success', '게시글이 성공적으로 작성되었습니다.');
    }

    // 개별 게시글을 보여주는 메서드
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // 게시글 수정 폼을 보여주는 메서드
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // 기존 게시글을 업데이트하는 메서드
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')
                         ->with('success', '게시글이 성공적으로 업데이트되었습니다.');
    }

    // 게시글을 삭제하는 메서드
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
                         ->with('success', '게시글이 성공적으로 삭제되었습니다.');
    }
}
