<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class PageController extends Controller
{
   
    //user profile edit
    public function userProfile () {
        return Inertia::render('EditUser');
    }

    // user update 
    public function postUserProfile (Request $request) {

        
    $id = Auth::user()->id;

        $user = User::where('id',$id)->first();

        // form validation
         $request->validate([
            'name' => 'required',
            'email' => 'required',
         
        ]);

        // check password
        if($request->password) {
            $hash = Hash::make($request->password);
        }else{
            $hash = $user->first()->password;
        }

        // image check
        if($file = $request->file('image')){
            $image_name =  uniqid().str_replace('','',$file->getClientOriginalName());
            $path = '/images/profile';
            $file->move(public_path($path),$image_name);
            $image_name_path = $path.$image_name;
        }else{
             $image_name_path = $user->first()->image;
        }

        // user updte
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hash,
            'image' =>    $image_name_path,
        ]);
     
        return back()->with('success','Update Success');

    }
}