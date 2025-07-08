<?php

namespace App\Http\Controllers;

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

    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout successful');
    }
}
