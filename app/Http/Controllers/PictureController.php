<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Picture;
use App\Http\Validation\PictureValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class PictureController extends Controller
{
    public function index(){
        $pictures=Picture::all();
        return response()->json($pictures);


    }
    public function show($id){
        $pictures=Picture::find($id);
        if(!$pictures){
            return response()->json(['message'=>'Ressource Not Found'],403);

        }
        return response()->json($pictures);


    }
    
    public function store(Request $request,PictureValidation $validation){
       // return response()->json(Auth::user());

        $validator=Validator::make($request->all(),$validation->rules(),$validation->messages());
        
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()],401);
        }
        
        $fullFileName=$request->file('image')->getClientOriginalName();
        $fileName=pathinfo($fullFileName,PATHINFO_FILENAME);
        $extension=$request->file('image')->getClientOriginalExtension();
        $file=$fileName.'_'.time().'.'.$extension;
        $request->file('image')->storeAs('public/pictures',$file);
        $picture=Picture::create([
            'image' =>$file,
            'title' => $request->input('title'),
            'description' =>$request->input('description'),
            'user_id' =>Auth::user()->id

        ]);

       // return response()->json($user);

    }

}
