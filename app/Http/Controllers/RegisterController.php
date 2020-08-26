<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
  public function register(Request $request)
  {
    $data = $request->input();
    //dd($data);
    $res = array(
      'success' => false,
      'message' => 'Please fix the error below.',
      'rs_class' => 'danger',
      'data' => []
    );
    $rules = [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      $res['success'] = false;
      $res['rs_class'] = 'danger';
      $res['message'] = 'Something went wrong. Please check the error(s):';
      $res['data'] = $validator->errors()->all();
      return back()->with('response', $res);
    } else {
      $user = new User();
      $user->name = $data['name'];
      $user->email = $data['email'];
      $user->password = Hash::make($data['password']);
      $createUser = $user->save();
      if ($createUser) {
        $res['success'] = true;
        $res['rs_class'] = 'success';
        $res['message'] = 'User registration has been completed successfully.';
      }

      return back()->with('response', $res);
    }
  }
}
