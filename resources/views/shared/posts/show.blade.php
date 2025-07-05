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

    </div>
@endsection