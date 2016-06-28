<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // Vistas autorizadas
        // Menos Index
        $this->middleware('jwt.auth', ['except' => ['index', 'store', 'destroy', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return response()->json($user->toArray());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valido
        /*$validator = Validator::make($request->all(), [
            "email" => "required|max:255",
            "password" =>"required"
        ]);
        if($validator->fails()){
            return response()->json(['error' =>'Invalid_fields'], 401);
        }
        // Guardo
        User::create($request->all());
        // Confirmo
        return response()->json(["mensaje"=>"Usuario creado correctamente"]);
        */
        $credentials = $request->all();
        $credentials['password'] = Hash::make($credentials['password']);
        $rules = array('email' => 'unique:users,email');
        $validator = Validator::make($credentials, $rules);

        if ($validator->fails()) {
            return response()->json(['error' => 'El usuario ya existe'], 500);
        }
        else {
            // Creo
            $user = User::create($credentials);
            return response()->json(compact('user'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['error' =>'No existe ese usuario'], 401);
        }
        return response()->json($user->toArray());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($user->all());
        return response()->json(['success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['success'], 200);
    }
}
