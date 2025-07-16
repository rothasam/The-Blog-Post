@extends('layouts.app')

@section('title')
<title>Login</title>
@endsection

@section('content')

<section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-200 to-blue-200">

    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
        
        <!-- Left Side: Branding or Image -->
        <div class="hidden md:flex flex-col items-center justify-center bg-green-500 text-white p-10">
            <h2 class="text-4xl font-bold mb-4">Welcome Back!</h2>
            <p class="text-lg">Please login to continue</p>
            <img src="{{ asset('images/login-illustration.svg') }}" alt="Login Illustration" class="w-3/4 mt-6">
        </div>

        <!-- Right Side: Login Form -->
        <div class="flex items-center justify-center p-10">
            <form action="{{ route('login.store') }}" method="POST" class="w-full max-w-md space-y-6">
                @csrf

                <h2 class="text-3xl font-bold text-gray-800">Login</h2>

                <x-input labelName="Email" id="email" name="email" type="email" class="w-full" />
                <x-input labelName="Password" id="pass" name="password" type="password" class="w-full" />

                <button type="submit" class="w-full py-3 bg-green-600 text-white rounded-xl shadow-md hover:bg-green-700 transition-all font-semibold text-lg">
                    Sign In
                </button>

                <div class="text-center">
                    <a href="{{ route('register') }}" class="text-sm text-green-600 hover:underline">Don't have an account? Register</a>
                </div>
            </form>
        </div>

    </div>

</section>

@endsection
