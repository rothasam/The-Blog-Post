<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        
        $profile = Profile::all();
        $user = User::all();
        return view('profile.index', compact('user', 'profile'));
    }
    
    // public function headerProfileInfo(){
    //     $user = User::all();
    //     return view('shared.header',compact('user'));
    // }

}
