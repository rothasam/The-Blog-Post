<?php

namespace App\Http\Controllers;

use App\Models\AuthorRequest;
use Illuminate\Http\Request;

class AuthorRequestController extends Controller
{
    public function create(){
        return view('reader.author_request.create');
    }

    public function store(Request $req){
        $data = $req->validate([
            'user_id' => 'required|exists:users,user_id',
            'describe' => 'required|string|max:255'
        ]);

        AuthorRequest::create($data);

        return redirect()->route('posts.index');
    }

    
}
