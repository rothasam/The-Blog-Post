<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all()->where('is_deleted',false);
        
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
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categories' => 'required|array', // all selected categories as an array, here incomming data ex : "categories": [2, 5, 9]
            'categories.*' => 'exists:categories,category_id', // each category must exist in the categories table
                                    // (.*)  it mean each item in array of categories
        ]);

        $thumbnailPath = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // $request['published_at'] = now();
        // $postData = $request->only([
        //     'user_id',
        //     'title',
        //     'description',
        //     'content',
        //     'thumbnail' => $thumbnailPath,
        // ]);

        // $postData['published_at'] = $request->input('published_at', now());

        $postData = [
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'thumbnail' => $thumbnailPath,
            'published_at' => $request->input('published_at', now()),
        ];

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

        $post->increment('count_view'); // increase 1 view

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
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,category_id',
        ]);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {

            // Delete old image if it exists and is not default
            if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail) && !str_contains($post->thumbnail, 'default')) {
                Storage::disk('public')->delete($post->thumbnail);
            }

            // Store new image with unique custom name
            $thumbnailPath = $request->file('thumbnail')->storeAs(
                'thumbnails',
                uniqid() . '_' . $request->file('thumbnail')->getClientOriginalName(),
                'public'
            );

            $post->thumbnail = $thumbnailPath;
        }


        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            // Thumbnail is already set above
        ]);

        $post->categories()->sync($request->categories);  // replaces old ones with new selections

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }


    public function destroy(Post $post)
    {
        Log::info('Deleting Post: ', ['post_id' => $post->post_id]);
        $post->is_deleted = true;
        $post->save();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }





}
