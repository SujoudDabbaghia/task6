<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register(Request $request)
    {
        $registerUserData = $request->validate([
           'name'=>'required|string',
           'email'=>'required|string|email|unique:users',
           'password'=>'required|min:8',
        ]);
        $user = User::create([
           'name'=>$registerUserData['name'],
           'email'=>$registerUserData['email'],
           'password'=>Hash::make($registerUserData['password']),
        ]);
        Auth::login($user);
        $token = $user->createToken($user->name.'_AuthToken')->plainTextToken;
        return  response()->json([
           'message'=>'User Create',
           'user'=>$user,
           'token'=>$token,
        ]);
    }   

    public function login(Request $request)
    {
        $loginUserData = $request->validate([
            'email'=>'required|string|email|unique:users',
            'password'=>'required|min:8',
         ]);
         $user = User::where('email',$loginUserData['email']->first());
         if(!$user || !Hash::check($loginUserData['password'],'12345678')){
             return returnError( 'Invalid Creadentails',401);
         }
         $token = $user->createToken($user->name.'_AuthToken')->plainTextToken;
        return  response()->json([
           'data'=>$user,
           'access_token'=>$token,
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return returnSuccessMessage('Successfully logged out',500);
    }

    public function test()
    {
        $user = User::all();
        return returnData($user,"");
    }
}
