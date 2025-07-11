<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLogin(){
        return view('auth.login');
    }
    
    public function login(Request $req){
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $userExists = User::where('email',$req->email)->first();

        if (!$userExists || !Hash::check($req->password, $userExists->password)) {
            return redirect()->back()->with('error', 'Not found');
        }

        Auth::login($userExists);

        $req->session()->regenerate();

        // return redirect()->intended('/dashboard')->with('success', 'Login successful');
        return redirect()->intended('/')->with('success', 'Login successful');

    }

    public function showRegister(){
        $genders = Gender::all();
        return view('auth.register',compact('genders'));
    }

    public function register(Request $req){
        $req->validate([
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'gender_id' => 'nullable|exists:genders,gender_id',
            'email' => 'required|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'first_name'     => $req->first_name,
            'last_name'     => $req->last_name,
            'gender_id' => $req->gender_id,
            'email'    => $req->email,
            'password' => Hash::make($req->password),
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout successful');
    }
}
