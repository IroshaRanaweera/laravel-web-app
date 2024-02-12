<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller{


    public function show(){
        return view('login');
    }

    public function login()
    {
        $credentials = request()->only(['email', 'password']);

        validator($credentials, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ])->validate();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return $user;
        }

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return response()->json(['errors' => ['Invalid email.']], 422);
        }
    
        // Inform about password mismatch
        return response()->json(['errors' => ['Incorrect password.']], 422);
    }

    public function logout(){
        
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'in:admin,superadmin,guest'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Create a new user instance
        $user = new User();
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']); // Hash the password before storing
        $user->role = $validatedData['role'];

        // Save the user to the database
        $user->save();

        // Redirect the user after successful registration
        return redirect('/')->with('success', 'Registration successful! Please log in.');
    }

    public function showRegisterPage(){
        return view('registration');

    }

}
