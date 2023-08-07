<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{
    public function store( Request $Request){
        $user_requested=Auth::User()->id;
        $family = Family::where('user_requested',$user_requested)
        ->where('user_id',$Request->user_id)
        ->first(); 
        if($family){
            $family->delete();
            return response()->json([
                'stetus'=>200,
                'message'=>"You removed a member from your family",
            ],200);
        }else{
            $family=Family::create([
            'user_requested'=>$user_requested,
            'user_id'=>$Request->user_id
        ]);
        if($family)  {
            return response()->json([
                'stetus'=>200,
                'message'=>"You added a member to your family",
                'friend'=>$family->load('user')
            ],200);
        }else{
                return response()->json([
                    'stetus'=>422,
                    'message'=>"something went woring"
                ],422);
            }
        }
    }
   
}
