<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ingredient;
use App\Recipe;
use Log;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        
        \DB::table('ingredient_recipe')->where('recipe_id', '=', $id)->delete();
        $recipe = Recipe::find($id);
        $ingredients = $request->all();
        foreach($ingredients as $ingredient){
            if (Ingredient::where('name', '=', $ingredient['text'])->exists()) {
                $dbIngredient = Ingredient::where('name', '=', $ingredient['text'])->get();
                $recipe->ingredients()->attach($dbIngredient[0]->id);
            }else{
                $newIngredient = new Ingredient;
                $newIngredient->name = $ingredient['text'];
                $newIngredient->save();
                $recipe->ingredients()->attach($newIngredient->id);
            }                    
        };
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getIngredient($query){
        $ingredient = Ingredient::where('name',  'LIKE', '%'.$query.'%')->get();
        return response()->json($ingredient->toArray());
    }
    public function getIngredientByRecipe($id){
        $recipeIngredients = array();
        $tags = \DB::table('ingredient_recipe')->where('recipe_id', '=', $id)->get();
        forEach($tags as $tag){
            $ingredient = Ingredient::find($tag->ingredient_id);
            array_push($recipeIngredients, $ingredient);
        }
        return $recipeIngredients;
    }
}
