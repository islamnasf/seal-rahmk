<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FriendPostsResource;
use App\Http\Resources\postResource;
use App\Models\Family;
use App\Models\FamilyPost;
use App\Models\Friend;
use App\Models\FriendPost;
use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\support\str;
use Illuminate\Support\Facades\Storage;

class postController extends Controller
{
    public function index(){
        $post=Post::Select("*")->orderby("id","ASC")->with('comments')->with('likes')->get(); //get() //paginate(2)
        if($post ->count() > 0){
            return response()->json([
                'status'=>200,
                'posts'=> postResource::collection($post)
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=> 'No Records Found '
            ],404);
        }
    }   

    //post for friend
    public function storePostFriend(Request  $Request){
        try{
            $user_id=Auth::user()->id;
            $friends =Friend::select('*')->where('user_requested','=',$user_id)->get();  
            if($Request->hasFile('image')){
                 $image = $Request->file('image');
                 $imageName=$image->getClientOriginalName();
                 $imagedb=$Request->file('image')->Move('posts',$imageName); 
             }
            $post=Post::create([
                'content'=> $Request->content,
                'user_id'=>$user_id,
                'image'=>$imagedb,
            ]);
            if($post){
                foreach($friends as $friend){
                FriendPost::create([
                    'post_id'=> $post->id,
                    'friend_id'=>$friend->id,
                ]);
            }
            }else{
                return response()->json([
                    'stetus'=>422,
                    'message'=>"something went woring"
                ],422);

            }

        
            return response()->json([
                'stetus'=>200,
                'message'=>"Post Created Successfully"
            ],200); 


        }catch(\Exception $e){
            return response()->json([
                'stetus'=>422,
                'message'=>"something went woring"
            ],422);

        }
    }
    //show posts friend
    
    public function showPostFriend(){
            $user_id=Auth::user()->id;
            $friends = Friend::where('user_id',$user_id)
            ->get();  
            
            if($friends->count() > 0){
                foreach($friends as $friend){
                $posts= FriendPost::where('friend_id',$friend->id)
                ->with('posts')
                ->get();
                }
                
                return response()->json([
                    'status'=>200,
                    'posts'=> FriendPostsResource::collection($posts)
                    //'posts'=> $posts->load('posts')
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=> 'No Posts Found '
                ],404);
            }   
    }
        //show posts friend
    
        public function showPostFamily(){
            $user_id=Auth::user()->id;
            $friends = Family::where('user_id',$user_id)
            ->get();  
            $posts = DB::table('posts')->Select("*")->orderby("id","ASC")
            ->leftJoin('family_posts','posts.id','=','family_posts.post_id')
            ->where('family_posts.family_id','=',$friends->id)
            ->with('comments')->with('likes')->get(); //get() //paginate(2)
            if($posts ->count() > 0){
                return response()->json([
                    'status'=>200,
                    'posts'=> postResource::collection($posts)
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=> 'No Posts Found '
                ],404);
            }   
    }
  
    //post for family
    public function storePostFamily(Request  $Request){
        try{
            $user_id=Auth::user()->id;
            $families = Friend::where('user_requested',$user_id)
            ->get(); 
            if($Request->hasFile('image')){
                 $image = $Request->file('image');
                 $imageName=$image->getClientOriginalName();
                 $imagedb=$Request->file('image')->Move('posts',$imageName); 
             }
            if($families){
            $post=Post::create([
                'content'=> $Request->content,
                'user_id'=>$user_id,
                'image'=>$imagedb,
            ]);
            if($post){
                foreach($families as $family){
                FamilyPost::create([
                    'post_id'=> $post->id,
                    'family_id'=>$family->id,
                ]);
            }
            }else{
                return response()->json([
                    'stetus'=>422,
                    'message'=>"something went woring"
                ],422);

            }
        }else{
            return response()->json([
                'stetus'=>422,
                'message'=>"something went woring"
            ],422);

        }
            return response()->json([
                'stetus'=>200,
                'message'=>"Post Created Successfully"
            ],200); 


        }catch(\Exception $e){
            return response()->json([
                'stetus'=>422,
                'message'=>"something went woring"
            ],422);

        }
 
    }
  
    public function update(Request $Request , int $post){
        $user_id=Auth::user()->id;
       // $posts = Post::find($post);
       $posts=Post::where('user_id',$user_id)->where('id',$post)->first();
        if($Request->hasFile('image')){
            $destination_path ='public/images/posts';  
            $image = $Request->file('image');
            $image_name=$image->getClientOriginalName();
            $Request->file('image')->storeAs($destination_path,$image_name); 
        }
        $posts->update([
            'content'=> $Request->content,
            //$Request->except('image'),
            'image'=>$image_name
        ]);
        if($posts){
            return response()->json([
                'stetus'=>200,
                'message'=>"Post Updated Successfully"
            ],200); 
        }else{
            return response()->json([
                'stetus'=>404,
                'message'=>"No Such Student Found !"
            ],404);
        }
    
    }
    public function destroy($post){
        //$posts = Post::find($post);
        $posts=Post::with('users')->where('id',$post)->first();
        if($posts){
            $posts->delete();
            return response()->json([
                'stetus'=>200,
                'message'=>"Post Deleted Successfully"
            ],200);
        }else{
            return response()->json([
                'stetus'=>404,
                'message'=>"No Such Post Found !"
            ],404);
        }
    } 
}
//