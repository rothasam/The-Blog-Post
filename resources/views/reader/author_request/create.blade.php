@extends('layouts.app')

@section('title')
    <title>Become an Author</title>
@endsection

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-indigo-700 mb-4 text-center">✍️ Apply to Become an Author</h1>
    <p class="text-gray-600 text-sm text-center mb-6">Share your passion and ideas with our readers! Fill out the form below to submit your request.</p>

    <form action="{{ route('author_request.store') }}" method="POST"  class="space-y-5">
        @csrf

        {{-- Motivation --}}
        <div>
            <x-input name="user_id" type="hidden" value="{{ auth()->user()->user_id }}"/>

            <x-textarea labelName="Why do you want to become an author?" 
                        name="describe" id="describe" 
                        placeholder="Tell us about your passion for writing, topics you're interested in, or any experience you have..." />
        </div>

        {{-- Sample File (Optional) --}}
        <div>
            <label for="sample" class="block text-sm font-medium text-gray-700 mb-1">Writing Sample (optional)</label>
            <input type="file" name="sample" id="sample"
                class="w-full border border-gray-300 rounded-md p-2 file:bg-indigo-600 file:text-white file:border-0 file:px-4 file:py-2 file:rounded-md file:cursor-pointer">
        </div>

        {{-- Submit --}}
        <div class="pt-2">
            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md shadow-md transition">
                🚀 Submit Request
            </button>
        </div>
    </form>
</div>
@endsection
