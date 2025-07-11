@extends('layouts.app')

@section('title')
    <title>404 Not Found</title>
@endsection

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-br from-red-100 via-yellow-50 to-purple-100 px-4">
    <div class="text-center">
        <h1 class="text-[100px] font-extrabold text-red-600 drop-shadow-lg">404</h1>
        <h2 class="text-3xl md:text-4xl font-semibold text-gray-800 mb-4">Oops! Page not found 🚧</h2>
        <p class="text-gray-600 mb-6 max-w-md mx-auto">The page you're looking for doesn't exist or has been moved. But don't worry, we've got plenty more for you to explore!</p>
        
        <a href="{{ route('posts.index') }}"
           class="inline-block bg-indigo-600 text-white font-medium px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition">
            ⬅️ Back to Home
        </a>
    </div>
</div>
@endsection
