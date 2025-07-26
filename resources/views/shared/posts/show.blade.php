@extends('layouts.app')

@section('title')
    <title>{{ $post->title }} | Blog Post</title>
@endsection

@section('content')

<div class="max-w-5xl mx-auto px-4 pb-8">
   {{-- 
    <a href="{{ route('admin.posts.index') }}" class="mb-5 inline-block text-gray-600 hover:underline">
        ← Back to blog list
    </a>
   --}}

    <!-- Post Header -->
    <div class="my-6">
        <h1 class="text-4xl font-bold text-indigo-800 mb-2 leading-snug">{{ $post->title }} 🎯</h1>
        <div class="flex flex-wrap items-center text-sm text-gray-500 gap-4">
            <span class="flex">
                 <img src="{{ asset('images/icons/calendar.svg') }}" alt="Icon" class="w-5 h-5 mr-1">
                {{ $post->formatDate($post->published_at) }}
            </span>
            <span class="flex">
                <img src="{{ asset('images/icons/eye.svg') }}" alt="Icon" class="w-5 h-5 mr-1">
                 {{ $post->count_view }} views
            </span>
            <span class="flex">
                 <img src="{{ asset('images/icons/writing-hand-svgrepo-com.svg') }}" alt="Icon" class="w-5 h-5 mr-1">
                {{ $post->users ? $post->users->first_name . ' ' . $post->users->last_name : 'Unknown Author' }}
            </span>
        </div>
    </div>

    <div class="aspect-[2.1] my-5">
        <img src="{{ $post->thumbnail != null ? asset('storage/' . $post->thumbnail) : asset('images/thumbnail.png') }}"
        alt="{{ $post->title }}"
        class="w-full h-full m-auto object-cover rounded-2xl">
    </div>

    <!-- Post Content -->
    <div class="prose max-w-none prose-indigo text-gray-800 mb-8">
        {!! nl2br(e($post->content)) !!}
    </div>

    <!-- Categories -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-2 flex items-center">
            <img src="{{ asset('images/icons/folder-svgrepo-com.svg') }}" alt="Icon" class="w-5 h-5 mr-2">
             Categories
        </h3>
        @if ($post->categories->count())
            <div class="flex flex-wrap gap-2">
                @foreach ($post->categories as $category)
                    <span class="inline-block bg-indigo-100 text-indigo-700 px-3 py-1 text-sm rounded-full font-medium">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
        @else
            <p class="text-gray-400">No categories assigned.</p>
        @endif
    </div>

    <!-- Like Button -->
    @auth
        @php
            $user_id = auth()->user()->user_id;
            $hasLiked = \App\Models\Like::where('user_id', $user_id)->where('post_id', $post->post_id)->exists();
        @endphp
    @endauth
    <form action="{{ route('likes.store', $post) }}" method="POST" class="mb-10">
        @csrf
       @if(auth()->check())  
            <x-input type="hidden" id="likePost" name="user_id" value="{{ $user_id }}"/> 
            <button type="submit"
                class="flex items-center gap-2 px-4 py-2 rounded-md font-medium transition
                {{ $hasLiked ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                <img src="{{ asset('images/icons/heart.svg') }}" alt="Icon" class="w-5 h-5">
                {{ $hasLiked ? 'Unlike' : 'Like' }} ({{ $post->count_like }})
            </button>
       @else
            <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 rounded-md font-medium transition
                bg-gray-200 text-gray-700 hover:bg-gray-300">
                <img src="{{ asset('images/icons/heart.svg') }}" alt="Icon" class="w-5 h-5">
                Like ({{ $post->count_like }})
            </button>
       @endif
       
        
    </form>

    <!-- Comments Section -->
    <div class="mb-10">
        <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center"> 
             <img src="{{ asset('images/icons/comment.svg') }}" alt="Icon" class="w-5 h-5 mr-2">
            Comments ({{ $post->comments->where('is_deleted', false)->count() }})
        </h3>

        @forelse($post->comments->where('is_deleted', false) as $com)
            <div class="p-4 bg-gray-50 border rounded-md mb-4 shadow-sm">
                <div class="flex justify-between items-center mb-1">
                    <div class="font-semibold text-indigo-700 flex items-center">
                        <img src="{{ auth()->user()->profile->avatar 
                            ? asset('storage/' . auth()->user()->profile->avatar) 
                            : asset('images/thumbnail.png') }}" alt="Avatar" class="mr-3 w-12 h-12 rounded-full object-cover">
                        {{ $com->users->first_name }} {{ $com->users->last_name }}
                    </div>
                    <div class="text-xs text-gray-400">{{ $com->created_at->diffForHumans() }}</div>
                </div>
                <p class="text-gray-700">{{ $com->describe }}</p>

                @auth
                    @if(auth()->user()->user_id === $com->user_id )
                        <form action="{{ route('comments.destroy', $com) }}" method="POST" class="mt-2 text-sm">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">🗑️ Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
        @empty
            <p class="text-gray-500 italic">No comments yet. Be the first to say something!</p>
        @endforelse
    </div>

    <!-- Add New Comment -->
    <div class="bg-white border rounded-lg shadow p-5 ">
            <h4 class="text-lg font-semibold mb-3 text-gray-800 flex items-center">
                <img src="{{ asset('images/icons/writing-hand-svgrepo-com.svg') }}" alt="Icon" class="w-5 h-5 mr-1">
                Leave a Comment
            </h4>
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf

            @auth   
                <x-input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->user_id }}"/>
            @endauth
            <x-input type="hidden" name="post_id" id="post_id" value="{{ $post->post_id }}"/>
            <x-textarea name="describe"  placeholder="Write your thoughts..."/>

            <div class="mt-3 text-right">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                    <img src="{{ asset('images/icons/message.svg') }}" alt="Icon" class="w-6 h-6 mr-1">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
