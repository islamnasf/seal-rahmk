<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Hadith;
use Illuminate\Http\Request;

class hadithController extends Controller
{
    public function index(){
        $hadith=Hadith::Select("*")->orderby("id","ASC")->paginate(2); //get() //paginate(2)
       // $courses=Course::all();
        if($hadith ->count() > 0){
            return response()->json([
                'status'=>200,
                'doaa'=> $hadith
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=> 'No Records Found '
            ],404);
        }
    }

    public function store(Request  $Request){
        
          $hadith = Hadith::create([
              'name'=> $Request->name,
              'content'=> $Request->content,
          ]);
          

          if($hadith){
              return response()->json([
                  'stetus'=>200,
                  'message'=>"Created Successfully"
              ],200); 
          }else{
              return response()->json([
                  'stetus'=>500,
                  'message'=>"something went woring"
              ],500);
              }   
      }
      //
    public function show($hadith){ //Student $student
        $hadith1 = Hadith::find($hadith);
        if($hadith1){
            return response()->json([
                'stetus'=>200,
                'doaa'=>$hadith1
            ],200); 
        }else{
            return response()->json([
                'stetus'=>404,
                'message'=>"No Found"
            ],404);
        }
    }
    public function update(Request $Request , int $hadith){
        $hadith1 = Hadith::find($hadith);
        $hadith1->update([
            'name'=> $Request->name,
            'content'=> $Request->content,
        ]);
        if($hadith1){
            return response()->json([
                'stetus'=>200,
                'message'=>"Updated Successfully"
            ],200); 
        }else{
            return response()->json([
                'stetus'=>404,
                'message'=>"No Found !"
            ],404);
        }
        
        //}
    }
    public function destroy($hadith){
        $hadith1 = Hadith::find($hadith);
        if($hadith1){
            $hadith1->delete();
            return response()->json([
                'stetus'=>200,
                'message'=>" Deleted Successfully"
            ],200);
        }else{
            return response()->json([
                'stetus'=>404,
                'message'=>"No Found !"
            ],404);
        }
    } 
}

