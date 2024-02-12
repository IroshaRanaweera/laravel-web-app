<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller{

    public function __invoke()
    {
        return view('welcome',[
            'user'=> auth()->user()
        ]);
    }
    

}
