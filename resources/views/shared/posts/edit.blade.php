@extends('layouts.app')

@section('title')
    <title>Edit Post</title>
@endsection

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Edit Post</h1>

    <form action="{{ route('posts.update', $post->post_id) }}" method="POST" class="space-y-5 bg-white p-6 shadow rounded-lg" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <x-input labelName="Title" name="title" id="title" value="{{ old('title', $post->title) }}"/>
            
        </div>

        <div>
            <x-input labelName="Description" name="description" id="description" value="{{ old('description', $post->description) }}"/>
        </div>

        <div>
            <label class="block font-medium">Thumbnail</label>
            <input type="file" name="thumbnail" class="w-full border rounded p-2" accept="image/*">
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
            <x-textarea name="content" id="content"   label="Content">{{ old('content', $post->content) }}</x-textarea>
           
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
