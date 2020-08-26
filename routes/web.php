<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Registration route
Route::post('/register/custom', [
  'uses' => 'RegisterController@register',
  'as'  => 'register.custom'
]);
// Login route
Route::post('/login/custom', [
  'uses' => 'LoginController@login',
  'as'  => 'login.custom'
]);

//group routes

Route::group(['middleware' => 'auth'], function () {
  Route::get('/dashboard', function () {
    return view('layouts.app');
  })->name('dashboard');
  /*   Route::get('/home', function () {
    return view('home');
  })->name('home'); */

  Route::resource('todos', 'TodoController');
});
