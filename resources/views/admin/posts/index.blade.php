@extends('layouts.app')

@section('content')



<div class="bg-white p-6 rounded-2xl shadow-md w-[90%] mx-auto  my-10">
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
                    <th class="py-3 px-4">Post</th>
                    {{-- <th class="py-3 px-4">Categories</th> --}}
                    <th class="py-3 px-4">Published</th>
                    <th class="py-3 px-4">Author</th>
                    <th class="py-3 px-4">Published at</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($posts as $post)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4">{{ $post->post_id }}</td>
                    <td class="py-3 px-4 font-medium text-gray-800">
                        <div class="flex items-center gap-3">
                            <div class="h-[50px] w-[105px]">
                                <img src="{{ $post->thumbnail != null ? asset('storage/' . $post->thumbnail) : asset('images/thumbnail.png') }}"
                                alt="{{ $post->title }}"
                                class="w-full h-full m-auto object-cover rounded">
                            </div>
                            <span>{{ $post->title }}</span>
                        </div>
                    </td>
                    {{-- 
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
                    --}}
                    <td class="py-3 px-4">{{ $post->formatDate($post->published_at)  }}</td>
                    {{-- 
                    <td class="py-3 px-4">
                        @if($post->is_published)
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full">Published</span>
                        @else
                            <span class="bg-red-100 text-red-700 text-xs px-2 py-0.5 rounded-full">Draft</span>
                        @endif
                    </td> --}}
                    <td class="py-3 px-4 ">
                        <div class="flex items-center gap-2">
                            <img src="{{ $post->users->profile->avatar 
                            ? asset('storage/' . $post->users->profile->avatar) 
                            : asset('images/thumbnail.png') }}" alt="Avatar" class="w-[24px] h-[24px] rounded-full object-cover">
                            <span>{{ $post->users->first_name . ' ' . $post->users->last_name }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-4">
                        {{ $post->formatDate($post->published_at) }}
                    </td>
                    <td class="py-3 px-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.posts.show', $post->post_id) }}"
                                class="flex items-center justify-center bg-yellow-400 hover:bg-yellow-500 rounded p-1 ">
                                <img src="{{ asset('images/icons/eye.svg') }}" alt="Icon" class="w-5 h-5">
                            </a>

                            {{-- 
                            <a href="{{ route('posts.edit', $post) }}"
                               class="text-sm text-yellow-600 hover:underline">Edit</a>
                            --}}
                            <form action="" method="POST" onsubmit="return confirm('Delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button class="flex items-center justify-center p-1 rounded bg-red-500 hover:bg-red-600">
                                    <img src="{{ asset('images/icons/delete.svg') }}" alt="Icon" class="w-5 h-5">
                                </button>
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