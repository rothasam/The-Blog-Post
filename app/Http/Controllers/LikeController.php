<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likePost(Post $post){
        $user_id = 1; // temp id

        $like = Like::where('user_id', $user_id)
                            ->where('post_id', $post->post_id)
                            ->first();
        if($like){
            $like->delete();
            return redirect()->back()->with('success', 'Unliked');
        }else{
            Like::create([
                'user_id' => $user_id,
                'post_id' => $post->post_id,
            ]);
            return redirect()->back()->with('success', 'Liked');
        }
    }
}
