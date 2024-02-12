<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller{

    public function show(){
        return view('login');
    }

    public function login()
    {
        validator(request()->all(), [
            'email' => ['required', 'email'],
            'password' => ['required']
        ])->validate();

        if(auth()->attempt(request()->only(['email','password']))){
            return redirect('/dashboard');

        }

        return redirect()->back()->withErrors(['email'=>'Invalid credentials']);
    }

    public function logout(){
        
        auth()->logout();
        return redirect('/');
    }


}
