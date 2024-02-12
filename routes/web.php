<?php

use Illuminate\Routing\PendingResourceRegistration;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/dashboard', 'App\Http\Controllers\DashboardController')->middleware('auth');

// Route::post('/login', function () {
//     return view('login');
// });

// Route::post('/login','App\Http\Controllers\AuthController@login');
Route::get('/logout','App\Http\Controllers\AuthController@logout' );

Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');

Route::get('/','App\Http\Controllers\AuthController@show')->name('login');

