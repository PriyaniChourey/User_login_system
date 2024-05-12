<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{

  function register()
  {
    return view(view:"auth.register");
  }
  public function login()
  {
    return view("auth.login");
  }

  function registerPost(Request $request)
  {
    $validate_data=$request->validate(
    [
      "name" => "required|string|max:255",
      "email" => "required|string|email|max:25|unique:users",
      "password" => "required|string|min:8",
    ]
    );

    $user = User::create([
      'name' => $validate_data['name'],
      'email' => $validate_data['email'],
      'password' => Hash::make($validate_data['password']),
  ]);


/*
$user=new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
   */
    if($user->save()){
      return redirect(route(name:"login"))->with("success","User created succesfully");
    
    }
    return redirect(route(name:"register"))->with(error,"Failed to create account");
  }
  function loginPost(Request $request)
  {
    $request->validate(
      [
        "email" => "required",
        "password" => "required",
      ]
      );
      $credentials = $request->only("email","password");
      if(Auth::attempt($credentials))
      {
        return redirect()->intended(route("home"));
      }
      return redirect(route(name:"login"))->with("error","Login Failed");
    }
     

  

  function logout(){
    Session::flush();
    Auth::logout();
    return redirect(route(name:"login"));
  }

}