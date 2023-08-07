<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Azkar;
use Illuminate\Http\Request;

class azkarController extends Controller
{
    public function index(){
        $azkar=Azkar::Select("*")->orderby("id","ASC")->paginate(2); //get() //paginate(2)
       // $courses=Course::all();
        if($azkar ->count() > 0){
            return response()->json([
                'status'=>200,
                'azkar'=> $azkar
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=> 'No Records Found '
            ],404);
        }
    }

    public function store(Request  $Request){
        
          $azkar = Azkar::create([
              'name'=> $Request->name,
              'content'=> $Request->content,
          ]);
          

          if($azkar){
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
    public function show($azkar){ //Student $student
        $azkar1 = Azkar::find($azkar);
        if($azkar1){
            return response()->json([
                'stetus'=>200,
                'azkar'=>$azkar1
            ],200); 
        }else{
            return response()->json([
                'stetus'=>404,
                'message'=>"No Found"
            ],404);
        }
    }
    public function update(Request $Request , int $azkar){
        $azkar1 = Azkar::find($azkar);
        $azkar1->update([
            'name'=> $Request->name,
            'content'=> $Request->content,
        ]);
        if($azkar1){
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
    public function destroy($azkar){
        $azkar1 = Azkar::find($azkar);
        if($azkar1){
            $azkar1->delete();
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
