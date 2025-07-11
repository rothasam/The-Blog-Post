@extends('layouts.app')

@section('content')

    <div class="w-[90%] mx-auto">
        <h1 class="text-3xl font-bold my-8">

            Dashboard
        </h1>
        <div  class="flex gap-5 ">
            <div class="w-1/4 bg-[#667eea] py-3 text-white rounded-3xl flex justify-center flex-col items-center">
                <span class="font-bold text-[40px]">
                    {{ $totalUser }}
                </span>
                <span class="flex">
                    <img src="{{ asset('images/icons/user-1-svgrepo-com.svg') }}" alt="Icon" class="w-6 h-6 mr-1">
                    Total User
                </span>
            </div>
            <div class="w-1/4 bg-[#667eea] py-3 text-white rounded-3xl flex justify-center flex-col items-center">
                <span class="font-bold text-[40px]">
                    {{ $totalPost }}
                </span>
                <span class="flex">
                    <img src="{{ asset('images/icons/user-1-svgrepo-com.svg') }}" alt="Icon" class="w-6 h-6 mr-1">
                    Total Post
                </span>
            </div>
            <div class="w-1/4 bg-[#667eea] py-3 text-white rounded-3xl flex justify-center flex-col items-center">
                <span class="font-bold text-[40px]">
                    {{ $totalAuthor }}
                </span>
                <span class="flex">
                    <img src="{{ asset('images/icons/user-1-svgrepo-com.svg') }}" alt="Icon" class="w-6 h-6 mr-1">
                    Total Author
                </span>
            </div>
            <div class="w-1/4 bg-[#667eea] py-3 text-white rounded-3xl flex justify-center flex-col items-center">
                <span class="font-bold text-[40px]">
                    1234
                </span>
                <span class="flex">
                    <img src="{{ asset('images/icons/user-1-svgrepo-com.svg') }}" alt="Icon" class="w-6 h-6 mr-1">
                    Total Request
                </span>
            </div>
        </div>


        
    </div>
@endsection