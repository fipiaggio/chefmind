<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Recipe;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Storage;

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

        //$file = $request->file('image');
        //Recipe::create($request->all());
        // Confirmo
        $validator = Validator::make($request->all(),[
            'file' => 'image'
        ]);
        $file = $request->file('file');
        $path = public_path()."/uploads";
        $fileName = str_random('16') . '.' . $file->getClientOriginalExtension();
        $file->move($path, $fileName);

        if(!$validator->fails()){
            return 'fallo';
        }

        return $request->all();

        

        // and you can continue to chain methods
        //$user = JWTAuth::parseToken()->authenticate();
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
