@extends('layouts.app')

@section('title')
    <title>Register</title>
@endsection

@section('content')
<section>
    <div class="w-full h-screen bg-green-100">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <form action="{{ route('register.store') }}" method="POST">
                    @csrf

                    <x-input labelName="First Name" id="first_name" name="first_name"  />
                    <x-input labelName="Last Name" id="last_name" name="last_name"  /> 
                    
                    <label for="">Gender</label>

                    <select name="gender_id" id="gender_id">
                        <option value="" disabled>Select gender</option>
                        @foreach ($genders as $gen)
                            <option value="{{ $gen->gender_id }}">{{ $gen->name }}</option>                        
                        @endforeach
                    </select>
                    <x-input labelName="Email" id="email" name="email" type="email" />
                    <x-input labelName="Password" id="password" name="password" type="password" />
                    <x-input labelName="Confirm Password" id="password_confirmation" name="password_confirmation" type="password" />

                    <button type="submit" class="btnPrimary">Register</button>
                </form>
            </div>
            <div class="bg-blue-300 h-screen"></div>
        </div>
    </div>
</section>
@endsection
