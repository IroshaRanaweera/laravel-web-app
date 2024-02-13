<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller{


    public function show()
    {
        return view('login');
    }

    public function login()
{
    $credentials = request()->only(['email', 'password']);

    validator($credentials, [
        'email' => ['required', 'email'],
        'password' => ['required']
    ])->validate();

    // Find the user by email
    $user = User::where('email', $credentials['email'])->first();

    if (!$user) {
        return response()->json(['errors' => ['Invalid email.']], 422);
    }

    // Check if the user is deactivated
    if ($user->deactivate) {
        return response()->json(['errors' => ['Your account is deactivated.']], 422);
    }

    // Attempt to authenticate the user
    if (Auth::attempt($credentials)) {
        // Authentication successful
        $user = Auth::user();
        return $user;
    }

    // Inform about password mismatch
    return response()->json(['errors' => ['Incorrect password.']], 422);
}

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

}
