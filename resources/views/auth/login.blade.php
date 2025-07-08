@extends('layouts.app')

@section('title')
    <section>
        
        <div class="w-full h-screen bg-green-200">
            <div class="grid grid-cols-2 gap-6">
                <div>

                    
                    <form action="{{ route('login') }}" method="POST">
                        @csrf   

                        <x-input labelName="Email"  name="email" type="email" />
                        <x-input labelName="Password" name="password" type="password"/>
                        <button type="submit" class="btnPrimary">Login</button>

                    </form>

                    
                </div>
                <div class="bg-blue-500 h-screen">
    
                </div>
                
            </div>
        </div>



    </section>
@endsection
