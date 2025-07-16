<!-- Reader & Author Panel (Tailwind CSS + Blade syntax) -->
@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-6">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Sidebar -->
    <aside class="bg-white rounded-xl shadow p-6 space-y-4">
      <div class="flex flex-col items-center">
        <img src="{{ auth()->user()->profile->avatar 
    ? asset('storage/' . auth()->user()->profile->avatar) 
    : asset('images/thumbnail.png') }}" alt="Avatar" class="w-24 h-24 rounded-full object-cover">
        <h2 class="mt-3 text-xl font-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h2>
        <p class="text-sm text-gray-500">{{ auth()->user()->profile->bio ?? 'No bio available' }}</p>
      </div>

<!-- Alpine.js Modal Trigger (outside modal container) -->
<div x-data="{ showModal: false }">
    <!-- Trigger Button -->
    <button @click="showModal = true"
        class="inline-block w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
        Edit Profile
    </button>

    <!-- Modal Backdrop Overlay -->
    <div x-show="showModal"
         x-transition.opacity
         class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40"
         @click="showModal = false">
    </div>

    <!-- Modal Edit profile -->
    <div x-show="showModal"
         x-transition
         class="fixed inset-0 flex items-center justify-center z-50"
         style="display: none;">
        <div @click.away="showModal = false"
             class="bg-white w-full max-w-md mx-auto rounded-xl shadow-xl p-6 transform transition-all duration-300">
            <h2 class="text-xl font-semibold mb-2">Edit profile information</h2>
            <form action="{{ route('profile.update', $userInfo->user_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-3">
                   <img src="{{ auth()->user()->profile->avatar 
    ? asset('storage/' . auth()->user()->profile->avatar) 
    : asset('images/thumbnail.png') }}" alt="Avatar" class="w-24 h-24 rounded-full object-cover">


                    <input type="file" name="avatar" class="w-full border rounded p-2" accept="image/*">
                    <x-input labelName="First Name" name="first_name" id="first_name" value="{{ old('first_name', $userInfo->first_name) }}" />
                    <x-input labelName="Last Name" name="last_name" id="last_name" value="{{ old('last_name', $userInfo->last_name) }} "/>
                    <select name="gender_id" id="gender_id">
                        <option value="{{ $userInfo->gender_id }}">{{ $userInfo->gender_id}}</option>
                        @foreach ($genders as $gen)
                            <option value="{{ $gen->gender_id }}">{{ $gen->name }}</option>
                        @endforeach
                    </select>
                    <x-input labelName="Email" name="email" id="email" value="{{ old('email', default: $userInfo->email) }} "/>
                    <x-input  labelName="Date of Birth"  name="dob" id="dob" type="date" value="{{ old('dob', $userInfo->dob ?? '') }}" />

                </div>

                <!-- ✅ Close Button -->
                <button @click="showModal = false"
                    class="mt-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                    Close
                </button>
                <button type="submit" class="mt-4 px-4 py-2 bg-indigo-700 text-white rounded hover:bg-indigo-900 transition">
                    Save
                </button>
            </form>
        </div>
    </div>
</div>

@if(auth()->user()->role_id === 3)
<!-- Alpine.js Modal Trigger (outside modal container) -->
<div x-data="{ showModal: false }">

    <button @click="showModal = true"  class="w-full px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-medium mt-2">
        Request History
      </button>

    <!-- Modal Backdrop Overlay -->
    <div x-show="showModal"
         x-transition.opacity
         class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40"
         @click="showModal = false">
    </div>

    <!-- Modal Edit profile -->
    <div x-show="showModal"
         x-transition
         class="fixed inset-0 flex items-center justify-center z-50"
         style="display: none;">
        <div @click.away="showModal = false"
             class="bg-white w-full max-w-md mx-auto rounded-xl shadow-xl p-6 transform transition-all duration-300">
            <h2 class="text-xl font-semibold mb-2">Request History</h2>
           

                <div class="space-y-3">
                  @forelse ($authorRequests as $req)
                      <div class="p-4 border border-gray-300 rounded-xl shadow-sm bg-white">
                          <div class="flex items-center justify-between mb-2">
                              <span class="text-sm text-gray-500">{{ $req->created_at->format('F d, Y') }}</span>
                              <span class="px-2 py-1 text-xs rounded-full
                                  @class([
                                      'bg-yellow-100 text-yellow-700' => $req->status === 'pending',
                                      'bg-green-100 text-green-700' => $req->status === 'approved',
                                      'bg-red-100 text-red-700' => $req->status === 'rejected',
                                  ])">
                                  {{ ucfirst($req->status) }}
                              </span>
                          </div>
                          <div class="text-gray-800">
                              <p class="font-semibold">Reason:</p>
                              <p class="text-sm">{{ $req->describe ?? 'N/A' }}</p>
                          </div>
                      </div>
                  @empty
                      <p class="text-sm text-gray-500">You have no request history yet.</p>
                  @endforelse
              </div>


                <!-- Close Button -->
                <button @click="showModal = false"
                    class="mt-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                    Close
                </button>
                <a href="{{ route('author_request.create') }}" class="mt-4 px-4 py-2 bg-indigo-700 text-white rounded hover:bg-indigo-900 transition">Make a request</a>
                
        </div>
    </div>
</div>

@endif


     
    </aside>

    <!-- Main Content -->
    <main class="col-span-2 space-y-8">
      <!-- Reader + Author Shared -->
      <div class="bg-white shadow rounded-xl p-6">
        <h3 class="text-lg font-semibold mb-4">📚 Your Bookmarks</h3>
        @if($bookmarkedPosts->isEmpty())
          <p class="text-gray-500">No bookmarks yet.</p>
        @else
          <ul class="space-y-2">
            @foreach($bookmarkedPosts as $bookmark)
              <li class="text-blue-600 hover:underline">
                <a href="{{ route('posts.show', $bookmark->post_id) }}">🔖 {{ $bookmark->title}}</a>
              </li>
            @endforeach
          </ul>
        @endif
      </div>

      <div class="bg-white shadow rounded-xl p-6 ">
        <h3 class="text-lg font-semibold mb-4 flex items-center">
          <img src="{{ asset('images/icons/comment.svg') }}" alt="Icon" class="w-5 h-5 mr-2">
          Your Comments
        </h3>
        {{-- 
        
        @if($comments->isEmpty())
          <p class="text-gray-500">You haven't commented yet.</p>
        @else
          <ul class="space-y-2">
            @foreach($comments as $comment)
              <li class="text-gray-700">
                📝 {{ Str::limit($comment->describe, 100) }} on
                <a href="{{ route('posts.show', $comment->post_id) }}" class="text-blue-600 hover:underline">{{ $comment->post->title }}</a>
              </li>
            @endforeach
          </ul>
        @endif
        --}}

        <ul class="space-y-2">
              <li class="text-gray-700">
                comement on
                <a href="#" class="text-blue-600 hover:underline">title</a>
              </li>
          </ul>
      </div>

      <!-- Author Only -->
      @if(auth()->user()->role_id === 2)
      <div class="bg-white shadow rounded-xl p-6">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold">📝 Your Posts</h3>
          <a href="{{ route('posts.create') }}" class="text-sm px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">+ New Post</a>
        </div>
        @if($posts->isEmpty())
          <p class="text-gray-500">You haven't written any posts yet.</p>
        @else
          <ul class="space-y-2">
            @foreach($posts as $post)
              <li>
                <a href="{{ route('posts.show', $post->post_id) }}" class="text-blue-600 hover:underline">📄 {{ $post->title }}</a>
              </li>
            @endforeach
          </ul>
        @endif
      </div>
      @endif

    </main>
  </div>
</div>


{{-- 
<!-- Alpine Wrapper -->
<div x-data="{ showModal: false }">
    
    <!-- Trigger Button -->
    <button @click="showModal = true"
        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
        🪄 Open Modal
    </button>

    <!-- Modal Background Overlay -->
    <div x-show="showModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
         @click.self="showModal = false">

        <!-- Modal Box -->
        <div x-show="showModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-90"
             class="bg-white w-full max-w-md p-6 rounded-xl shadow-xl"
             @click.stop>
             
            <h2 class="text-xl font-semibold mb-4">✨ Smooth Modal</h2>
            <p class="mb-4 text-gray-600">This modal opens and closes with smooth transitions using Alpine.js.</p>
            
            <button @click="showModal = false"
                class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                Close
            </button>
        </div>
    </div>
</div>
--}}





@endsection
