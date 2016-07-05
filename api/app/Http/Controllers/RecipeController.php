<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Recipe;
use App\Step;
use App\User;
use App\Ingredient;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Storage;
use Input;
use Log;

class RecipeController extends Controller
{

    public function __construct()
    {
        // Vistas autorizadas
        // Menos Index
        $this->middleware('jwt.auth', ['except' => ['index', 'store', 'destroy', 'show', 'getStepByRecipes', 'getRecipeByIngredients']]);
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
        $user = JWTAuth::parseToken()->authenticate();
        if($user){
            if(Input::hasFile('file')){
                $file = $request->file('file');
                $steps = json_decode($request->steps);
                $ingredients = json_decode($request->ingredients);

                $path = public_path()."/uploads";
                $fileName = time().'-'.$file->getClientOriginalName();
                $file->move($path, $fileName);

                $recipe = new Recipe;
                $recipe->name = $request->name;
                $recipe->description = $request->description;
                $recipe->img = $fileName;
                $recipe->dificulty = $request->dificulty;
                $recipe->time = $request->time;
                $recipe->cost = $request->cost;
                $recipe->people = $request->people;
                $recipe->user_id = $user->id;
                $recipe->save();

                foreach($steps as $step){
                    $newStep = new Step;
                    $newStep->description = $step->description;
                    $newStep->recipe_id = $recipe->id;
                    $newStep->save();
                };

                foreach($ingredients as $ingredient){
                    if (Ingredient::where('name', '=', $ingredient->text)->exists()) {
                        $dbIngredient = Ingredient::where('name', '=', $ingredient->text)->get();
                        $recipe->ingredients()->attach($dbIngredient[0]->id);
                    }else{
                        $newIngredient = new Ingredient;
                        $newIngredient->name = $ingredient->text;
                        $newIngredient->save();
                        $recipe->ingredients()->attach($newIngredient->id);
                    }                    
                };
                return response()->json(['Receta creada correctamente'], 200);
            }
            return response()->json(['error' =>'Falta cargar imagen'], 401);
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

    public function getStepsByRecipes($id)
    {
        $steps = Step::where('recipe_id', $id)->get();
        return $steps;
    }

    public function getRecipeByUser()
    {
        $user = JWTAuth::parseToken()->authenticate();
        if($user){
            $suser = User::find($user->id);
            $recipes = $suser->recipes()->get();
            return $recipes;
        }
    }

    public function getRecipeByIngredients(Request $request)
    {
        // Separo ingredientes
        $ingredients = array();
        forEach($request->all() as $ingredient){
            $dbIngredient = \DB::table('ingredients')->where('name', '=', $ingredient['text'])->get();
            array_push($ingredients, $dbIngredient);
        };

        // Busco en la tabla pivot
        $pivotIngredients = array();
        forEach($ingredients as $ingredient){
            forEach($ingredient as $ing){
            $pivotIngredient = \DB::table('ingredient_recipe')->where('ingredient_id', '=', json_encode($ing->id))->get();
            array_push($pivotIngredients, $pivotIngredient); 
            }
           
        }

        // Separo resultados
        $resultRecipes = array();
        forEach($pivotIngredients as $pi){
            forEach($pi as $p){
                $recipeWithTag = \DB::table('recipes')->where('id', '=', json_encode($p->recipe_id))->get();
                array_push($resultRecipes, $recipeWithTag); 
            }
        }

        // Preparo recetas para la respuesta
        $finalResultRecipes = array();
        forEach($resultRecipes as $resultRecipe){
            forEach($resultRecipe as $finalRecipe){
                array_push($finalResultRecipes, $finalRecipe);
            }
        }
        
        $input = array_map("unserialize", array_unique(array_map("serialize", $finalResultRecipes)));

        return $input;

    }


}
