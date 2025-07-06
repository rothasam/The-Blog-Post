<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class BookmarkController extends Controller
{
    public function bookmarkPost(Post $post){

        $bookmark = Bookmark::where('post_id',1)
                            ->where('post_id',$post->post_id)
                            ->first();
        if($bookmark){
            $bookmark->delete();
            // return redirect('posts.index');
            return redirect()->back()->with('success', 'Bookmark removed successfully!');
        }else{
            Bookmark::create([
                'post_id' => $post->post_id,
                'user_id' => 1, // temp user
            ]);
            return redirect()->back()->with('success', 'Bookmark added successfully!');
        }
    }

    public function index(){
        $user = User::find(1); // temp user

        // Load bookmarked posts with full details
        $bookmarkedPosts = $user->bookmarkedPosts;
        return view('shared.bookmarks.index', compact('bookmarkedPosts'));
    }

}
