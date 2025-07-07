@extends('layouts.app')

@section('title')
    <title>Post</title>
@endsection

@section('content')
    <div>
        <h1 class="text-blue-900 text-[40px]">{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>
        <p>Publish at {{ $post->formatDate($post->published_at) }}</p>
        <p>Author: <span class="text-red-700 font-bold">{{ $post->users ? $post->users->first_name . ' ' . $post->users->last_name : 'Unknown' }}</span></p>

        @if ($post->categories->count())
            <ul class="list-disc list-inside">
                @foreach ($post->categories as $category)
                    <li>{{ $category->name }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No categories</p>
        @endif

        @php
            $user_id = 1;
            $hasLiked = \App\Models\Like::where('user_id', $user_id)->where('post_id', $post->post_id)->exists();
        @endphp

        <form action="{{ route('likes.store', $post) }}" method="POST">
            @csrf
            <button type="submit" class="px-3 py-1 rounded {{ $hasLiked ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                {{ $hasLiked ? 'Unlike' : 'Like' }}
            </button>
        </form>

        <h3>Count View : {{ $post->count_view }}</h3>

        <h3 class="font-bold text-lg mb-2">Comments ({{ $post->comments->count() }})</h3>

        @foreach($post->comments->where('is_deleted', false) as $com)
            <div class="p-3 border rounded my-2">
                <div>
                    <p class="font-semibold">{{ $com->users->first_name }} {{ $com->users->last_name }}</p>
                    <p>{{ $com->describe }}</p>
                    <p class="text-sm text-gray-500">{{ $com->created_at->diffForHumans() }}</p>
                </div>
                <div>
                    <form action="{{ route('comments.destroy', $com) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach

        <div>
            <h5>Leave comment</h5>
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="text" name="post_id" value="{{ $post->post_id }}" hidden>
                    <textarea name="describe" rows="3" class="w-full p-2 border rounded" placeholder="Write your comment here..." required></textarea>
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Submit</button>
            </form>
        </div>

    </div>
@endsection