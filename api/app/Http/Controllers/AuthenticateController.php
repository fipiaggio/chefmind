<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticateController extends Controller
{
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
