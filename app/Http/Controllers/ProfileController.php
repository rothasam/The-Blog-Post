<?php

namespace App\Http\Controllers;

use App\Models\AuthorRequest;
use App\Models\Gender;
use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    
    // public function headerProfileInfo(){
    //     $user = User::all();
    //     return view('shared.header',compact('user'));
    // }

    public function getProfile(){
        $user = User::find(Auth::user()->user_id); 

        // Load bookmarked posts with full details
        $bookmarkedPosts = $user->bookmarkedPosts;
        $userInfo = Auth::user();
        $genders = Gender::all();
         $authorRequests = AuthorRequest::where('user_id', Auth::id())->get();
        $posts = Post::where('user_id',Auth::id())->where('is_deleted',false)->get();
        return view('shared.profile.index',compact('bookmarkedPosts','userInfo','genders','authorRequests','posts'));
    }

    public function updateProfile(Request $req, $id){

        Log::info($req->all());
        $req->validate([
            'first_name' => 'nullable|string|max:20',
            'last_name' => 'nullable|string|max:20',
            'gender_id' => 'nullable|exists:genders,gender_id',
            // 'email' => 'nullable|unique:users,email', // email is duplicated so fix later
            // 'password' => 'required|string|min:6|confirmed'
            'dob' => 'nullable|date',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        

        // $profile = new Profile();
        // if ($req->hasFile('avatar')) {

        //     // Delete old image if it exists and is not default
        //     if ($profile->avatar && Storage::disk('public')->exists($profile->avatar) && !str_contains($profile->avatar, 'default')) {
        //         Storage::disk('public')->delete($profile->avatar);
        //     }

        //     // Store new image with unique custom name
        //     $avatarPath = $req->file('avatar')->storeAs(
        //         'avatar',
        //         uniqid() . '_' . $req->file('avatar')->getClientOriginalName(),
        //         'public'
        //     );

        //     $profile->avatar = $avatarPath;
        // }

        $user = User::findOrFail($id);

        $profile = $user->profile; // get existing profile, could be null
        if ($req->hasFile('avatar')) {
            if ($profile && $profile->avatar && Storage::disk('public')->exists($profile->avatar) && !str_contains($profile->avatar, 'default')) {
                Storage::disk('public')->delete($profile->avatar);
            }

            $avatarPath = $req->file('avatar')->storeAs(
                'avatars',
                uniqid() . '_' . $req->file('avatar')->getClientOriginalName(),
                'public'
            );
        }

        $user->update([

            'first_name' => $req->first_name,
            'last_name'  => $req->last_name,
            'gender_id' => $req->gender_id,
            'email' => $req->email,
            'dob' => $req->dob,

        ]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->user_id],   // condition to find profile
            ['avatar' => $avatarPath ?? $user->profile->avatar ?? null] // update with new avatar path or keep old
        );

        return redirect()->route('profile')->with('success', 'Profile updated');
    }
}
