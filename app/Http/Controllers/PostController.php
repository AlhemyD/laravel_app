<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('deleted_at', null)->get();;
		$comments = Comment::where('is_approved', true)->get();
        return view('posts.index', compact('posts','comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
			'publish_at' => 'required'
        ]);

        //Post::create($request->all());
		Post::create($request->only(['title', 'content','publish_at']));
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
		
        $post = Post::with('comments')->find($id);
		return view('posts.show', compact('post'));
    }
	public function storeComment(Request $request, $postId)	
    {		
        $request->validate([
            'author' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Comment::create([
            'post_id' => $postId,
            'author' => $request->author,
            'content' => $request->content,
            'is_approved' => false,
        ]);

       return redirect()->route('posts.index', $postId)->with('success', 'Комментарий добавлен, ожидает модерации.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update($request->all());
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
	
	
	public function publish(Post $post)
    {
        $post->published = true;
		$post->published_at = now();
        $post->save();
        return redirect()->route('posts.index');
    }

    public function unpublish(Post $post)
    {
        $post->published = false;
        $post->save();
        return redirect()->route('posts.index');
    }
}
