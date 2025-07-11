@extends('layouts.app')



@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow p-6 mb-8 text-white">
        <h1 class="text-3xl font-bold">Admin Profile</h1>
        <p class="mt-1 text-sm">Manage your profile and view account details.</p>
    </div>

    <!-- Profile Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center space-x-6 mb-6">
            <img src="{{ asset('images/icons/user-1-svgrepo-com.svg') }}" alt="Profile Picture"
                class="w-24 h-24 rounded-full border-4 border-indigo-300 object-cover">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Name</h2>
                <p class="text-sm text-gray-500">email</p>
                <p class="text-sm text-gray-500">Role: haha</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
            <div>
                <p class="font-semibold">Phone:</p>
                <p>phone</p>
            </div>
            <div>
                <p class="font-semibold">Joined:</p>
                <p>created</p>
            </div>
        </div>

        <div class="mt-6">
            <a href="#"
                class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                Edit Profile
            </a>
        </div>
    </div>

</div>
@endsection
