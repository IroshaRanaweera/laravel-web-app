<?php

use Illuminate\Routing\PendingResourceRegistration;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth','user-role:admin,superadmin'])->group(function(){
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController')->name('dashboard');
});


Route::middleware(['auth','user-role:guest'])->group(function(){
    Route::get('/welcome', 'App\Http\Controllers\WelcomeController')->name('welcome');
});


Route::get('/logout','App\Http\Controllers\AuthController@logout' );


Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');

Route::get('/','App\Http\Controllers\AuthController@show')->name('login');


Route::get('/register','App\Http\Controllers\AuthController@showRegisterPage' );

Route::post('/register','App\Http\Controllers\AuthController@register')->name('register');

Route::get('/users','App\Http\Controllers\UserController@index' );



