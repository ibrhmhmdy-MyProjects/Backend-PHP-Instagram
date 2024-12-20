<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(User $user){
        return \view('users.profile',compact('user'));
    }

    public function edit(User $user){
        // \abort_if(auth()->id() !== $user->id,403,'You are not authorized to see this page');
        \abort_if(auth()->user()->cannot('edit-update-profile',$user),403);
        return \view('users.edit', \compact('user'));
    }
    public function update(User $user, UpdateUserProfileRequest $request){
        $data = $request->safe()->collect();

        if($data['password'] == ''){
            unset($data['password']);
        }else{
            $data['password'] = Hash::make($data['password']);
        }

        if($data->has('image')){
            $path = $request->file('image')->store('profile','public');
            $data['image'] = $path;
        }

        $data['private_account'] = $request->has('private_account');

        $user->update($data->toArray());
        
        return \redirect(route('userProfile',$user->username));
    }
    public function follow(User $user){
        auth()->user()->follow($user);
        return \back();
    }
    public function unfollow(User $user){
        auth()->user()->unfollow($user);
        return \back();
    }
}
