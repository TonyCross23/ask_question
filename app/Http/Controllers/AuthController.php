<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    //login 
    public function login () {
        return Inertia::render('Auth/Login');
    }

    // post login 
    public function postLogin (Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credential = $request->only('email','password');
        if(Auth::attempt($credential)){
            return redirect('/')->with('success','Welcome'.Auth::user()->name);
        };
    }

    // register 
    public function register () {
        return Inertia::render('Auth/Register');
    }

    // psot method register 
    public function postRegister (Request $request) {
       $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'image' => 'required|mimes:png,jpg,jpeg',
            'password' => 'required|min:8',
       ]);

    //    image upload
    $image = $request->file('image');
    $image_name = uniqid().str_replace('','',$image->getClientOriginalName());
    $image_path = '/images/profile/';
    $image->move(public_path('images/profile'),$image_name);

       $user = new User();
       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = Hash::make($request->password);
       $user->image = $image_path.$image_name;
       $user->save();

       $credential = $request->only('email','password');
       if(Auth::attempt($credential)){
            return Redirect::route('home');
       };
    }

    // logout
    public function logout () {
        Auth::logout();
        return Redirect::route('login');
    }
}