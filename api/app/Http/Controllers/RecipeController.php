<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Recipe;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class RecipeController extends Controller
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
        $recipes = Recipe::all();
        return response()->json($recipes->toArray());
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
        $validator = Validator::make($request->all(), [
            "name" => "required|max:255",
            "description" =>"required"
        ]);
        if($validator->fails()){
            return response()->json(['error' =>'Invalid_fields'], 401);
        }
        // Guardo
        Recipe::create($request->all());
        // Confirmo
        return response()->json(["mensaje"=>"Receta creada correctamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);
        if(!$recipe){
            return response()->json(['error' =>'No existe esa receta'], 401);
        }
        return response()->json($recipe->toArray());
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
        $recipe = Recipe::find($id);
        $recipe->update($request->all());
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
        $recipe = Recipe::find($id);
        $recipe->delete();
        return response()->json(['success'], 200);
    }
}
