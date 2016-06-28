<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;
use Hash;
use Validator;

class AuthenticateController extends Controller
{
    public function __construct(){
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the index method.
       $this->middleware('cors');
       //$this->middleware('jwt.auth', ['except' => ['register']]);
    }

    public function register(Request $request){

        $credentials = $request->all();
        $credentials['password'] = Hash::make($credentials['password']);
        $credentials['level_id'] = 1;

        $rules = array('email' => 'unique:users,email');

        $validator = Validator::make($credentials, $rules);

        if ($validator->fails()) {
            return response()->json(['error' => 'El usuario ya existe'], 500);
        }
        else {
            // Envio
            $user = User::create($credentials);
            $token = JWTAuth::fromUser($user);
            return response()->json(compact('token', 'user'));
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userAuth(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = null;
        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(['error' =>'invalid_credentials'], 401);
            };
        }catch(JWTException $ex){
            return response()->json(['error' => 'something_gone_wrong'], 500);
        };

        $user = JWTAuth::toUser($token);
        return response()->json(compact('token', 'user'));
    }
}
