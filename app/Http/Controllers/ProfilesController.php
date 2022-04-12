<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Auth;

class ProfilesController extends Controller
{
    public function edit(User $user){

        $user = auth()->user();

        return view('profiles.edit', [ 'user' => $user]);
    }
}
