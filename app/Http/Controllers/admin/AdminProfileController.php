<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
   public function index(){
        $user = User::find(Auth::user()->user_id);
        $userInfo = Auth::user();
        $genders = Gender::all();
        return view('admin.profile.index', compact('user','userInfo','genders')); 
   }

}
