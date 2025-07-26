@extends('layouts.app')

@section('title')
<title>Register</title>
@endsection

@section('content')

<section class="h-screen flex items-center justify-center bg-gradient-to-br from-purple-100 via-purple-200 to-white">

    <div class="w-full xl:max-w-[60%] lg:max-w-[75%] md:max-w-[85%] sm:max-w-[90%] bg-white rounded-2xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
        
        <!-- Left Side: Illustration -->
        <div class="hidden md:flex flex-col items-center justify-center bg-indigo-600 text-white p-10">
            <div>
                <a href="{{ route('posts.index') }}" class="text-xl font-bold text-red-600 hover:underline">
                <img src="{{ asset('images/logo.png') }}" alt="" class="w-[200px] mb-4">
                </a>
            </div>
            <h2 class="lg:text-4xl text-3xl font-bold mb-4">Join Us!</h2>
            <p class="text-lg">Create your account and get started</p>
            <img src="{{ asset('images/form/register.png') }}" alt="Register Illustration" class="w-3/4 mt-6">
        </div>

        <!-- Right Side: Form -->
        <div class="flex items-center justify-center p-8">
            <form action="{{ route('register.store') }}" method="POST" class="w-full max-w-md space-y-5">
                @csrf

                <h2 class="text-3xl font-bold text-gray-800 text-center">Register</h2>

                <!-- First + Last Name Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-input icon="true" iconName="person" placeholder="First Name" labelName="First Name" id="first_name" name="first_name" />
                    <x-input icon="true" iconName="person" placeholder="Last Name" labelName="Last Name" id="last_name" name="last_name" />
                </div>

                <!-- Gender Dropdown -->
                <div>
                    <select 
                        name="gender_id" 
                        id="gender_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        required
                    >
                        <option value="" disabled selected>Select gender</option>
                        @foreach ($genders as $gen)
                            <option value="{{ $gen->gender_id }}">{{ $gen->name }}</option>
                        @endforeach
                    </select>
                    @error('gender_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-input icon="true" iconName="email" placeholder="Email" labelName="Email" id="email" name="email" type="email" />
                <x-input icon="true" iconName="password" placeholder="Password" labelName="Password" id="password" name="password" type="password" />
                <x-input icon="true" iconName="password" placeholder="Confirm password" labelName="Confirm Password" id="password_confirmation" name="password_confirmation" type="password" />

                <button type="submit" class="w-full py-2 bg-indigo-600 text-white rounded shadow-md hover:bg-indigo-700 transition-all font-semibold text-lg">
                    Register
                </button>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">Already have an account? Login</a>
                </div>
            </form>
        </div>

    </div>

</section>

@endsection
