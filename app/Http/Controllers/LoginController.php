<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
  public function login(Request $request)
  {
    //dd($request->all());
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      return redirect()->route('dashboard');
    } else {
      $res['success'] = false;
      $res['rs_class'] = 'danger';
      $res['message'] = 'Something went wrong. Please check the error(s):';
      $res['data'] = ['User email or password is not valid.'];
      return back()->with('response', $res);
    }
  }
}
