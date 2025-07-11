@extends('layouts.app')

@section('title')
    <title>Create Post</title>
@endsection

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8 flex items-center justify-center gap-2">
        📝 Create New Post
    </h1>

    <form action="{{ route('posts.store') }}" method="POST" class="space-y-6 bg-white p-8 shadow-lg rounded-2xl" enctype="multipart/form-data">
        @csrf

        <!-- Title -->
        <div>
            <x-input labelName="Title" id="title" name="title"/>
        </div>

        <!-- Description -->
        <div>
            <x-input labelName="Description" id="description" name="description"/>
        </div>

        <!-- Categories -->
        <div>
            <label for="categories" class="block text-sm font-medium text-gray-700 mb-1">Categories</label>
            <select name="categories[]" id="categories" multiple size="5"
                class="block w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-1">Hold <kbd class="px-1 py-0.5 bg-gray-100 rounded border">Ctrl</kbd> or <kbd class="px-1 py-0.5 bg-gray-100 rounded border">Cmd</kbd> to select multiple</p>
        </div>

        <!-- Hidden user ID -->
        <input type="hidden" name="user_id" value="{{ auth()->user()->role_id }}">

        <div>
            <label class="block font-medium">Thumbnail</label>
            <input type="file" name="thumbnail" class="w-full border rounded p-2" accept="image/*">
        </div>
        
        <!-- Content (rich text) -->
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
            <textarea name="content" id="content" rows="7"
                class="block w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                required></textarea>
        </div>

        <!-- Submit button -->
        <div>
            <button type="submit"
                class="w-full inline-flex justify-center items-center px-4 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition focus:ring-2 focus:ring-indigo-500">
                🚀 Publish Post
            </button>
        </div>
    </form>
</div>

@endsection
