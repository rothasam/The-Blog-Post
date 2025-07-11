<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){

        $totalPost = Post::all()->where('is_deleted',false)->count();
        $totalAuthor = User::all()->where('role_id',2)->count();
        $totalUser = User::all()->count();
        

        return view('admin.dashboard.index',compact('totalPost','totalAuthor','totalUser'));
    }
}
