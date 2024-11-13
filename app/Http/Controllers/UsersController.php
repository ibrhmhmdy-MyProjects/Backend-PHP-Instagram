<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(User $user){
        return \view('users.profile',compact('user'));
    }

    public function edit(User $user){
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
}
