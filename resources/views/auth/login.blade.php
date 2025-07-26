@extends('layouts.app')

@section('title')
<title>Login</title>
@endsection

@section('content')

<section class="h-screen flex items-center justify-center bg-gradient-to-br from-purple-100 via-purple-200 to-white">

    <div class=" w-full xl:max-w-[60%] lg:max-w-[75%] md:max-w-[85%] sm:max-w-[90%] bg-white rounded-2xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
       

        <div class="flex items-center justify-center p-10">
            <form action="{{ route('login.store') }}" method="POST" class="w-full max-w-md space-y-6">
                @csrf

                <h2 class="text-3xl text-center font-bold text-gray-800">Login</h2>

                <x-input icon="true" iconName="email" placeholder="Email" labelName="Email" id="email" name="email" type="email" class="w-full" />
                <x-input icon="true" iconName="password" placeholder="Password" labelName="Password" id="pass" name="password" type="password" class="w-full" />

                <button type="submit" class="w-full py-2  text-white rounded shadow-md bg-indigo-600 hover:bg-indigo-700 transition-all font-semibold text-lg">
                    Login
                </button>

                <div class="text-center">
                    <a href="{{ route('register') }}" class="text-sm text-indigo-600 hover:underline">Don't have an account? Register</a>
                </div>
            </form>
        </div>


         <div class="hidden md:flex flex-col items-center justify-center bg-indigo-600  text-white p-10">
             <div>
                <a href="{{ route('posts.index') }}" class="text-xl font-bold text-red-600 hover:underline">
                <img src="{{ asset('images/logo.png') }}" alt="" class="w-[200px] mb-4">
                </a>
            </div>
            <h2 class="lg:text-4xl text-3xl font-bold mb-4">Welcome Back!</h2>
            <p class="text-lg">Please login to continue</p>
            <img src="{{ asset('images/form/login.png') }}" alt="Login Illustration" class="w-3/4 mt-6">
        </div>

    </div>

</section>

@endsection
