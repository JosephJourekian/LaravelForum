<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth;
use App\Models\Threads;

class ProfilesController extends Controller
{
    public function edit(User $user){

        $user = auth()->user();

        return view('profiles.edit', [ 'user' => $user]);
    }

    public function update(User $user){

        $user = auth()->user();

        $attributes = request()->validate([
            'email' => ['string','required','email','max:255',
                Rule::unique('users')->ignore($user),
            ],
            'password' => ['string','required','min:8','max:255','confirmed',],
        ]);   
        $attributes['password'] = Hash::make($attributes['password']);
        if(request('avatar'))
        {
            $attributes['avatar'] = request('avatar')->store('pics', 'public');
        }   
        $user->update($attributes);
        
        return redirect()->back()->with('message', 'Profile Updated!');
    }

    public function myPosts(){

        $threads = Threads::where('user_id', auth()->user()->id)->get();
        
        return view('profiles.myPosts', ['threads' => $threads]);

    }
}
