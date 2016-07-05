<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use File;

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
}
