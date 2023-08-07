<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class friendController extends Controller
{
    public function store( Request $Request){
        $user_requested=Auth::User()->id;
        $friend = Friend::where('user_requested',$user_requested)
        ->where('user_id',$Request->user_id)
        ->first(); 
        if($user_requested==$Request->user_id){
            return response()->json([
                'stetus'=>422,
                'message'=>"something went woring"
            ],422);
        }
        if($friend){
            $friend->delete();
            return response()->json([
                'stetus'=>200,
                'message'=>"You removed a friend",
            ],200);
        }else{
        $friend=Friend::create([
            'user_requested'=>$user_requested,
            'user_id'=>$Request->user_id
        ]);
        if($friend)  {
            return response()->json([
                'stetus'=>200,
                'message'=>"You added a friend",
                'friend'=>$friend->load('user')
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
