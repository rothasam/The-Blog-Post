<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    private $posts = [
        [
            'user_id' => 1,
            'title' => '10 Tips to Improve Your Coding Skills',
            'description' => 'Simple and effective tips to boost your programming.',
            'content' => 'Learning to code is a journey. Practice consistently, read others’ code, and don’t be afraid to break things to learn...',
            'thumbnail' => '..',
            'is_deleted' => false,
            'published_at' => "2025/22/02",
            'created_at' => "2025/22/02",
            'updated_at' => "2025/22/02",
        ],
        [
            'user_id' => 2,
            'title' => 'Understanding Laravel Middleware',
            'description' => 'Middleware lets you filter HTTP requests easily.',
            'content' => 'Laravel middleware acts as a bridge between a request and a response. You can use it for authentication, logging, and more...',
            'thumbnail' => '',
            'is_deleted' => false,
            'published_at' => "2025/22/02",
            'created_at' => "2025/22/02",
            'updated_at' => "2025/22/02",
        ],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all()->where('is_deleled',false);
        
        // return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        Post::create($request->all());

        // Redirect or return view
        // return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id); // Automatically throws 404 if not found

        // return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
