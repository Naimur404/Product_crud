<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAuth extends Controller
{
  public function index(){
    return view('admin.components.loginform');
  }
  public function register(){
    return view('admin.components.register');
  }
  public function user_register_submit(Request $request){
    $request->validate([
        'email' => 'required|email',
        'name'  => 'required',
        'phone' => 'required|numeric',
        'password' => 'required'
    ]);

     $information = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password)
     ];

     DB::table('users')->insert($information);
     return redirect()->route('user.login')->with('success', 'Register Sucessfully Please login');


  }
  public function user_login(Request $request){
    $request->validate([
        'password' => 'required'
    ]);
    {
        if(is_numeric($request->get('email'))){
            $credentail =  ['phone'=>$request->get('email'),'password'=>$request->get('password')];
            if(Auth::guard('web')->attempt($credentail)){
                return redirect()->route('dashboard');
              }else{
              return redirect()->route('user.login')->with('error','Information is not correct');

              }
        }
        elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            $credentail = ['email' => $request->get('email'), 'password'=>$request->get('password')];
            if(Auth::guard('web')->attempt($credentail)){
                return redirect()->route('dashboard');
              }else{
              return redirect()->route('user.login')->with('error','Information is not correct');

              }
        }

      }

  }
  public function forgetpass(){
    return view('admin.components.forget_password');
  }

  public function logout(){
    Auth::guard('web')->logout();
    return redirect()->route('user.login');

  }

}
