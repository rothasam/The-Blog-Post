@extends('layouts.app')

@section('title')
    <title>Bookmarks</title>

@endsection

@section('content')
    <div class="max-w-[80%] mx-auto py-4">
        <h1 class="text-2xl font-bold mb-4">My Bookmarked Posts</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($bookmarkedPosts as $post)
                <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition-shadow">
                    
                    <img src="{{ asset('images/thumbnail.png') }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">

                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                        <p class="text-gray-600 mb-4">{{ $post->description }}</p>

                        <a href="{{ route('posts.show', $post->post_id) }}" class="text-blue-500 hover:underline">Read More</a>
                    </div>
                </div>
            @empty
                <p>You have no bookmarks yet.</p>
            @endforelse
        </div>
    </div>
@endsection