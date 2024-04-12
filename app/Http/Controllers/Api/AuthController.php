<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function users()
    {
        $users=User::get();
       
        
        return response()->json(['data' => $users,'message' => 'listing of users'],200);
    }

    public function store(StorePostRequest $req)
    {
        $attributes = $req->validated();

        // $file = $req->file('image');
        // $filename = time().'_'.$file->getClientOriginalName();
        // $file->storeAs('public/',$filename);
       
        $attributes += $req->validate([
            'password' => 'required|min:8|max:255',
            'cpassword' => 'required|same:password',

        ]);
        $attributes['password'] = Hash::make($attributes['password']);

        unset($attributes['cpassword']);

        $attributes['qualification'] = implode(',', $attributes['qualification']);
        // $attributes['image'] = $filename;
       
        $user= User::create($attributes);
        $token = $user->createToken('API Token')->accessToken;

        return response()->json(['data' => $user,'message' => 'user created','token' => $token],200);
      
    }

    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|min:3|max:255',
            'password' => 'required'
        ]);

        $auth = Auth::attempt(['email' =>  $req->email, 'password' => $req->password]);


        if ($auth == false) {
            return response()->json(['message'=>'Invalid Credentials']);
        } else {
            return response()->json(['message'=>'user logged in successfully']);
        }
}
}