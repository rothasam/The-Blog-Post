<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function bookmarkPost(Post $post){

        $user_id = Auth::id();

        $bookmark = Bookmark::where('user_id',$user_id)
                            ->where('post_id',$post->post_id)
                            ->first();
        if($bookmark){
            $bookmark->delete();
            // return redirect('posts.index');
            return redirect()->back()->with('success', 'Bookmark removed successfully!');
        }else{
            Bookmark::create([
                'post_id' => $post->post_id,
                'user_id' => $user_id,
            ]);
            return redirect()->back()->with('success', 'Bookmark added successfully!');
        }
    }

    public function index(){
        $user = User::find(Auth::user()->user_id); // temp user

        // Load bookmarked posts with full details
        $bookmarkedPosts = $user->bookmarkedPosts;
        return view('shared.bookmarks.index', compact('bookmarkedPosts'));
    }

}
