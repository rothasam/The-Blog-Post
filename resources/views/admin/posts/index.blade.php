@extends('layouts.app')

@section('content')



<div class="bg-white p-6 rounded-2xl shadow-md w-[90%] mx-auto  mt-10">
    <!-- Header -->
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-xl font-semibold flex items-center gap-2">
            Lists All Posts
        </h2>
        <a href="{{ route('posts.create') }}"
           class="bg-indigo-500 hover:bg-indigo-600 text-white text-sm px-4 py-2 rounded-lg shadow flex items-center gap-1">
            ➕ Add Post
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-xl shadow-sm">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700 font-medium">
                <tr>
                    <th class="py-3 px-4">#</th>
                    <th class="py-3 px-4">Title</th>
                    <th class="py-3 px-4">Categories</th>
                    <th class="py-3 px-4">Published</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($posts as $index => $post)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4">{{ $index + 1 }}</td>
                    <td class="py-3 px-4 font-medium text-gray-800">{{ $post->title }}</td>
                    <td class="py-3 px-4">
                        @if($post->categories->count())
                            <div class="flex flex-wrap gap-1">
                                @foreach($post->categories as $cat)
                                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full text-xs">{{ $cat->name }}</span>
                                @endforeach
                            </div>
                        @else
                            <span class="text-gray-400 text-xs">No categories</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">{{ $post->formatDate($post->published_at)  }}</td>
                    <td class="py-3 px-4">
                        @if($post->is_published)
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full">Published</span>
                        @else
                            <span class="bg-red-100 text-red-700 text-xs px-2 py-0.5 rounded-full">Draft</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('posts.show', $post) }}"
                               class="text-sm text-blue-600 hover:underline">View</a>
                            <a href="{{ route('posts.edit', $post) }}"
                               class="text-sm text-yellow-600 hover:underline">Edit</a>
                            <form action="" method="POST" onsubmit="return confirm('Delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-sm text-red-600 hover:underline">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection