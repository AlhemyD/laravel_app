<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
	public function index()
	{
		$comments = Comment::where('is_approved', false)->get();
		return view('comments.index',compact('comments'));
	}
	
    public function store(Request $request, Post $post) {
		$request->validate(['content' => 'required|string']);
		$comment = $post->comments()->create($request->all());
		
		return redirect()->back();
	}
	public function approve(Comment $comment)
    {
        $comment->is_approved = true;
		$comment->save();
        return redirect()->back()->with('success','Комментарий одобрен.');
    }
}
