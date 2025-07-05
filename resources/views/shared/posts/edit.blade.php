@extends('layouts.app')

@section('title')
    <title>Edit Post</title>
@endsection

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Edit Post</h1>

    <form action="{{ route('posts.update', $post->post_id) }}" method="POST" class="space-y-5 bg-white p-6 shadow rounded-lg">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <input type="text" name="description" id="description" value="{{ old('description', $post->description) }}"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
        </div>
        
        <div>
            <label for="categories" class="block text-sm font-medium text-gray-700 mb-1">Categories</label>
            <select name="categories[]" multiple size="5" id="categories"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}"
                        {{ in_array($category->category_id, old('categories', $post->categories->pluck('category_id')->toArray())) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
            <textarea name="content" id="content" rows="5"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full inline-flex justify-center items-center px-4 py-2 rounded-md bg-indigo-600 text-white font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Update Post
            </button>
        </div>

    </form>

</div>
@endsection
