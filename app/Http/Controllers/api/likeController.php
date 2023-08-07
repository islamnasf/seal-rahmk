<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class likeController extends Controller
{
    public function store($post_id){
        $user_id=Auth::user()->id;
       // $post_id=Post::find($post);
       $like = Like::where('user_id',$user_id)
                    ->where('post_id',$post_id)
                    ->first(); //get()
        if($like){
            $like->delete();
            return response()->json([
                'stetus'=>200,
                'message'=>"You unliked a Post",
            ],200);
        }else{
            $like=Like::create([
                'user_id'=>$user_id,
                'post_id'=>$post_id
            ]);   
            if($like->save())  {
                return response()->json([
                    'stetus'=>200,
                    'message'=>"You liked a Post",
                    'like'=>$like->load('users')

                ],200);
            }else{
                return response()->json([
                    'stetus'=>500,
                    'message'=>"something went woring"
                ],500);
            }
        }
    }
}
