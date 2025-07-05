<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all()->where('is_deleled',false);
        
        return view('shared.posts.index',compact('posts'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('shared.posts.create', compact('categories'));
    }


    public function store(Request $request)
    {

        Log::info('Request Data: ', $request->all());
        
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'title' => 'required|string|max:90',
            'description' => 'required|string|max:180',
            'content' => 'required|string',
            'thumbnail' => 'nullable',
            'categories' => 'required|array', // all selected categories as an array, here incomming data ex : "categories": [2, 5, 9]
            'categories.*' => 'exists:categories,category_id', // each category must exist in the categories table
                                    // (.*)  it mean each item in array of categories
        ]);


        // $request['published_at'] = now();
        $postData = $request->only([
            'user_id',
            'title',
            'description',
            'content',
            'thumbnail',
        ]);

        $postData['published_at'] = $request->input('published_at', now());

        // store in tb posts
        $post = Post::create($postData);
        
        // store in tb post_category
        $post->categories()->attach($request->categories);
        // $post->categories()->attach($request->input('categories'));

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }


    public function show(string $id)
    {
        
        // Log::info('Data: ' . $post);
        // Log::info('ID' . $post->post_id);
        // Log::info('ID' . $id);
        //Laravel uses Post::findOrFail(15) internally and injects the found Post model into this show().
        // If the post is not found, it will throw a ModelNotFoundException and Laravel will automatically return a 404 response.

        $post = Post::find($id);
        if (!$post) {
            return view('shared.not_found');
        }


        return view('shared.posts.show', compact('post'));
    }

    public function edit(string $id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        if (!$post) {
            return view('shared.not_found');
        }
 
        return view('shared.posts.edit', compact('post','categories'));
    }


    public function update(Request $request, Post $post)
    {
        // dd($post);
        Log::info('Request Data: ', $request->all());

        $request->validate([
            // 'user_id' => 'required|exists:users,user_id',
            'title' => 'required|string|max:90',
            'description' => 'required|string|max:180',
            'content' => 'required|string',
            'thumbnail' => 'nullable|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,category_id',
        ]);

        $updateData = $request->only([
            // 'user_id',
            'title',
            'description',
            'content',
            'thumbnail',
        ]);

        $post->update($updateData);

        $post->categories()->sync($request->categories);  // replaces old ones with new selections

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }


    public function destroy(string $id)
    {
        //
    }
}
