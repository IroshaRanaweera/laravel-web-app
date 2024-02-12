<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller{

    public function __invoke()
    {
        return view('dashboard',[
            'user'=> auth()->user()
        ]);
    }
    

}
