<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{

    public function index()
    {
        $posts = Post::all()->where('is_deleted',false);
        
        return view('admin.posts.index',compact('posts'));
    }

    public function show(int $id){
        $post = Post::find($id);
        if (!$post) {
            return view('shared.not_found');
        }

        $post->increment('count_view'); // increase 1 view

        return view('shared.posts.show', compact('post'));
    }

    
}
