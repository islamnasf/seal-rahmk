<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Azkar;
use App\Models\Doaa;
use App\Models\Hadith;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class doaaController extends Controller
{
    public function index(){
        $doaa=Doaa::Select("*")->orderby("id","ASC")->paginate(2); //get() //paginate(2)
       // $courses=Course::all();
        if($doaa ->count() > 0){
            return response()->json([
                'status'=>200,
                'doaa'=> $doaa
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=> 'No Records Found '
            ],404);
        }
    }

    public function store(Request  $Request){
        
          $doaa = Doaa::create([
              'name'=> $Request->name,
              'content'=> $Request->content,
          ]);
          

          if($doaa){
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
    public function show($doaa){ //Student $student
        $doaa1 = Doaa::find($doaa);
        if($doaa1){
            return response()->json([
                'stetus'=>200,
                'doaa'=>$doaa1
            ],200); 
        }else{
            return response()->json([
                'stetus'=>404,
                'message'=>"No Found"
            ],404);
        }
    }
    public function update(Request $Request , int $doaa){
        $doaa1 = Doaa::find($doaa);
        $doaa1->update([
            'name'=> $Request->name,
            'content'=> $Request->content,
        ]);
        if($doaa1){
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
    public function destroy($doaa){
        $doaa1 = Doaa::find($doaa);
        if($doaa1){
            $doaa1->delete();
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
