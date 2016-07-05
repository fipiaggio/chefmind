<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use File;
use Storage;
use App\Recipe;

class ImageController extends Controller
{
    public function getImage($name){
        $filepath = public_path('uploads/').$name;
        if(File::exists($filepath)){
            return Response::download($filepath);
        }else{
            return response()->json(['error' =>'Falta cargar imagen'], 401);
        }
        
    }

    public function replaceImage(Request $request){

    	$image = $request->file('file');
    	$id = $request->name;
    	$recipe = Recipe::find($id);
    	$fileName = time().'-'.$image->getClientOriginalName();
    	$recipe->img = $fileName;
    	$recipe->save();

    	$path = public_path()."/uploads";
    	
    	$image->move($path, $fileName);

    	return $request->all();
	    
    }
}
