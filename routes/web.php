<?php

use Illuminate\Routing\PendingResourceRegistration;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', 'App\Http\Controllers\DashboardController')->middleware('auth');

Route::get('/logout','App\Http\Controllers\AuthController@logout' );


Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');

Route::get('/','App\Http\Controllers\AuthController@show')->name('login');


Route::get('/register','App\Http\Controllers\AuthController@showRegisterPage' );

Route::post('/register','App\Http\Controllers\AuthController@register')->name('register');



