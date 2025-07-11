<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'post_id' => 'required|exists:posts,post_id',
            'describe' => 'required|string|max:200',
        ]);

        // Comment::create($request->all());
        Comment::create([
            'user_id'   => $request->user_id, 
            'post_id'   => $request->post_id,
            'describe'  => $request->describe,
        ]);

        return redirect()->back()->with('success', 'Comment added.');
    }

    public function destroy(Comment $comment){
        

        $comment->is_deleted = true; 
        $comment->save();
        
        return redirect()->back()->with('success', 'Comment deleted.');
    }
}
