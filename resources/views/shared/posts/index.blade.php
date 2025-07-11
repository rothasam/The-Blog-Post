@extends('layouts.app')

@section('title')
    <title>Posts</title>
@endsection


@section('content')
    <div class="max-w-7xl mx-auto py-10 px-4">
    <h2 class="text-2xl font-semibold mb-6 flex items-center gap-2">
        All Articles
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($posts as $post)
            <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 flex flex-col">
                <div class="h-44">
                    <img src="{{ $post->thumbnail != null ? asset('storage/' . $post->thumbnail) : asset('images/thumbnail.png') }}"
                     alt="{{ $post->title }}"
                     class="w-full h-full object-cover">
                </div>

                

                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800 line-clamp-2">
                        {{ $post->title }}
                    </h3>

                    <p class="text-sm text-gray-600 mb-4 line-clamp-3 flex-grow">
                        {{ $post->description }}
                    </p>

                    <div class="flex items-center justify-between text-xs text-gray-500 mt-auto pt-3 border-t">
                        <span class="flex items-center">
                            <img src="{{ asset('images/icons/calendar.svg') }}" alt="Icon" class="w-5 h-5 mr-1">
                             {{ $post->formatDate($post->published_at) }}
                        </span>

                        <div class="flex items-center gap-3 text-sm">
                            @php
                                $isBookmarked = \App\Models\Bookmark::where('user_id', 1)->where('post_id', $post->post_id)->exists();
                            @endphp

                            <!-- Bookmark -->
                            <form action="{{ route('bookmarks.store', $post) }}" method="POST">
                                @csrf
                                <button type="submit" class="{{ $isBookmarked ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}">
                                    <i class="fa-solid fa-bookmark"></i>
                                </button>
                            </form>

                            @auth

                                @if(auth()->user()->role_id == 2)

                                    <!-- Edit -->
                                    <a href="{{ route('posts.edit', $post) }}" class="text-gray-500 hover:text-yellow-500">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <!-- Delete -->
                                    <button onclick="openModal('{{ $post->post_id }}')" class="text-gray-500 hover:text-red-600">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                @endif

                            @endauth

                            <!-- Read more -->
                            <a href="{{ route('posts.show', $post->post_id) }}" class="text-indigo-600 hover:underline font-medium">
                                Read
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>




    <!-- modal delete -->

    <div>
        <div id="deleteModal"  class="relative z-10 hidden" aria-labelledby="dialog-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                        <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-base font-semibold text-gray-900" id="dialog-title">Delete Post ?</h3>
                        <div class="mt-2">
                        <p class="text-sm text-gray-500">Are you sure you want to delete this post? This action cannot be undone.</p>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <form id="onDelete" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"  class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">Yes</button>
                    </form>
                    <button type="button" onclick="closeModal()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">No</button>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>

@section('scripting')

<script>
function openModal(post_id) {
    post_id = parseInt(post_id);
    // alert(typeof(post_id));
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('onDelete').action = `/posts/${post_id}`;
}

function closeModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>

@endsection

@endsection