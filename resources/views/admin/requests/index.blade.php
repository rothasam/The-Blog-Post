@extends('layouts.app')

@section('content')
<div class="w-[90%] mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Author Requests -->
    <div class="bg-white p-6 rounded-2xl shadow-md md:col-span-2">
        <!-- Header -->
        <div class="flex justify-between items-center mb-5">
            <h2 class="text-xl font-semibold flex items-center gap-2">
                <img src="{{ asset('images/icons/writing-hand-svgrepo-com.svg') }}" alt="Icon" class="w-5 h-5 mr-1">
                Author Applications
            </h2>
            <a href="#" class="bg-indigo-500 hover:bg-indigo-600 text-white text-sm px-4 py-2 rounded-lg flex items-center gap-1 shadow">
                 View All
            </a>
        </div>

        <!-- Application Dropdown List -->
        <div class="space-y-4  h-full flex items-center justify-center">
        @if($author_req->isEmpty())
            <p class="text-gray-500 text-sm ">No request.</p>
        @else
            @foreach($author_req as $req)
            <div x-data="{ open: false }" class="bg-gray-50 p-4 rounded-xl shadow-sm">
                <!-- Summary Header -->
                <div @click="open = !open" class="cursor-pointer flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold text-gray-800">
                            {{ $req->users->first_name . ' ' . $req->users->last_name }}
                        </h3>
                        <p class="text-sm text-gray-600 flex items-center gap-2">
                            📧 {{ $req->users->email }} • 🗓️ Applied: {{ $req->created_at->format('d M Y') }} 
                            <span class="text-xs text-gray-400">({{ $req->created_at->diffForHumans() }})</span>
                        </p>
                    </div>
                    <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <!-- Dropdown Detail -->
                <div x-show="open" x-transition class="mt-3 text-sm text-gray-700 border-t pt-3 space-y-2">
                    <p>🧾 <strong>Describe:</strong> {{ $req->describe }}</p>
                    <p>🧬 <strong>Bio:</strong> {{ $req->users->profile->bio ?? 'N/A' }}</p>
                    <p>📱 <strong>Phone:</strong> {{ $req->users->profile->phone ?? 'N/A' }}</p>
                    <p>📍 <strong>Address:</strong> {{ $req->users->profile->address ?? 'N/A' }}</p>

                    <!-- Actions -->
                    <form action="{{ route('admin.author_request.update', $req) }}" method="POST" class="flex gap-2">
                        @csrf
                        @method('PUT')
                        
                        <button type="submit" name="status" value="approved"
                            class="bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-1.5 rounded-lg flex items-center gap-1">
                            <img src="{{ asset('images/icons/check-mark-button-svgrepo-com.svg') }}" alt="" class="w-5 h-5 mr-1">
                            Approve
                        </button>

                        <button type="submit" name="status" value="rejected"
                            class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-1.5 rounded-lg flex items-center gap-1">
                            ❌ Reject
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        @endif
        </div>
    </div>

    <!-- Recently Approved Sidebar -->
    <div class="bg-white p-6 rounded-2xl shadow-md h-fit">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <img src="{{ asset('images/icons/check-mark-button-svgrepo-com.svg') }}" alt="" class="w-5 h-5 mr-1"> 
            Recently Approved
        </h3>

        @if($recent_approved->isEmpty())
            <p class="text-gray-500 text-sm">No recent approvals.</p>
        @else
            <ul class="space-y-3 text-sm text-gray-800">
                @foreach($recent_approved as $approved)
                    <li class="flex justify-between items-center border-b pb-2">
                        <div>
                            <p class="font-medium">{{$approved->users->user_id . '. ' . $approved->users->first_name }} {{ $approved->users->last_name }}</p>
                            <span class="text-xs text-gray-500">{{ $approved->updated_at->diffForHumans() }}</span>
                        </div>
                        <span class="text-green-600 text-xs font-semibold bg-green-100 px-2 py-0.5 rounded">Approved</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</div>
@endsection
