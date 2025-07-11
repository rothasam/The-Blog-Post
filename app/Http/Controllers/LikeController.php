<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likePost(Request $req,Post $post){
        
        $user_id = $req->input('user_id');
        // validate ?

        $like = Like::where('user_id', $user_id)
                            ->where('post_id', $post->post_id)
                            ->first();
        if($like){
            $like->delete();
            $post->decrement('count_like');
            return redirect()->back()->with('success', 'Unliked');
        }else{
            Like::create([
                'user_id' => $user_id,
                'post_id' => $post->post_id,
            ]);
            $post->increment('count_like');

            return redirect()->back()->with('success', 'Liked');
        }
    }
}
