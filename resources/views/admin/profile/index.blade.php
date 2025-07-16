@extends('layouts.app')



@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    

    <!-- Profile Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center space-x-6 mb-6">
            <img src="{{ auth()->user()->profile->avatar 
            ? asset('storage/' . auth()->user()->profile->avatar) 
            : asset('images/thumbnail.png') }}" alt="Avatar" class="w-24 h-24 rounded-full border-4 border-indigo-300 object-cover">
            
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">{{ $user->first_name . ' ' . $user->last_name}}</h2>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
            <div>
                <p class="font-semibold">Role:</p>
                <p>{{ $user->roles->name }}</p>
            </div>
            <div>
                <p class="font-semibold">Joined:</p>
                <p>{{  $user->created_at  }}</p>
            </div>
        </div>

        <div class="mt-6">

            <!-- Modal Edit Profile (Smooth Alpine.js Animation) -->
        <div x-data="{ showEditModal: false }">

            <!-- Trigger -->
            <button @click="showEditModal = true"
                class="inline-block w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                ✏️ Edit Profile
            </button>

            <!-- Overlay -->
            <div x-show="showEditModal"
                x-transition.opacity
                class="fixed inset-0 bg-black bg-opacity-50 z-40 backdrop-blur-sm"
                @click="showEditModal = false">
            </div>

            <!-- Modal -->
            <div x-show="showEditModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
                class="fixed inset-0 z-50 flex items-center justify-center px-4"
                style="display: none;"
                @keydown.escape.window="showEditModal = false">
                <div @click.away="showEditModal = false"
                    class="bg-white w-full max-w-md p-6 rounded-xl shadow-xl">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Profile</h2>

                    <form action="{{ route('profile.update', $userInfo->user_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div class="flex justify-center">
                                <img src="{{ $userInfo->profile->avatar 
                                    ? asset('storage/' . $userInfo->profile->avatar) 
                                    : asset('images/thumbnail.png') }}" 
                                    alt="Avatar" class="w-20 h-20 rounded-full object-cover border-2 border-indigo-300">
                            </div>

                            <input type="file" name="avatar" class="w-full border rounded px-3 py-2" accept="image/*">

                            <x-input labelName="First Name" name="first_name" id="first_name" value="{{ old('first_name', $userInfo->first_name) }}" />
                            <x-input labelName="Last Name" name="last_name" id="last_name" value="{{ old('last_name', $userInfo->last_name) }}" />

                            <label for="gender_id" class="block text-sm font-medium text-gray-700">Gender</label>
                            <select name="gender_id" id="gender_id" class="w-full border rounded px-3 py-2">
                                <option value="{{ $userInfo->gender_id }}">{{ $userInfo->gender->name ?? 'Select' }}</option>
                                @foreach ($genders as $gen)
                                    <option value="{{ $gen->gender_id }}">{{ $gen->name }}</option>
                                @endforeach
                            </select>

                            <x-input labelName="Email" name="email" id="email" value="{{ old('email', $userInfo->email) }}" />
                            <x-input labelName="Date of Birth" name="dob" id="dob" type="date" value="{{ old('dob', $userInfo->dob) }}" />
                        </div>

                        <div class="mt-6 flex justify-between">
                            <button type="button" @click="showEditModal = false"
                                class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        </div>
    </div>

</div>
@endsection
