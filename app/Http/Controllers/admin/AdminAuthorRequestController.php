<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AuthorRequest;
use Illuminate\Http\Request;

class AdminAuthorRequestController extends Controller
{
    public function index(){
        
        // $author_req = AuthorRequest::orderBy('author_request_id','desc')
        //                             ->where('status','pending')
                                   
        //                             ->get();

        $author_req = AuthorRequest::with('users')
                                ->where('status', 'pending')
                                ->whereHas('users', function ($query) {
                                    $query->where('role_id', 3);
                                })
                                ->orderBy('author_request_id', 'desc')
                                ->get();


        $recent_approved = AuthorRequest::where('status', 'approved')
                                        ->with('users')
                                        ->latest('updated_at')
                                        ->take(5)
                                        ->get();


        return view('admin.requests.index',compact('author_req','recent_approved'));
    }

    public function updateRequest(Request $req, AuthorRequest $authorRequest){
        $req->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $authorRequest->status = $req->status;
        $authorRequest->save();

        if ($req->status === 'approved') {
            $user = $authorRequest->users;  // users here is the function in AuthorRequest Model
            if ($user) { // user record exists
                $user->role_id = 2; 
                $user->save();
            }
        }

         return back()->with('success', 'Status updated successfully!');
    }

}
