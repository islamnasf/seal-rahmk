<?php

use App\Http\Controllers\api\azkarController;
use App\Http\Controllers\api\commentController;
use App\Http\Controllers\api\doaaController;
use App\Http\Controllers\api\friendController;
use App\Http\Controllers\api\hadithController;
use App\Http\Controllers\api\likeController;
use App\Http\Controllers\api\postController;
use App\Http\Controllers\api\searchController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware'=>'api','prefix'=>'auth'],function($router){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::get('/profile',[AuthController::class,'profile']);
    Route::post('/logout',[AuthController::class,'logout']);
});
Route::group(['middleware'=>'auth:api'],function($router){
    Route::get('post',[postController::class,'index']);
    Route::post('post',[postController::class,'storePostFriend']);
    Route::get('post_friend',[postController::class,'showPostFriend']);

    //Route::get('post/{id}',[postController::class,'show']);
    Route::put('post/{id}/edit',[postController::class,'update']);
    Route::delete('post/{id}/delete',[postController::class,'destroy']);
    //comment
    Route::post('comment',[commentController::class,'store']);
    Route::delete('comment/{id}/delete',[commentController::class,'destroy']);
    //likes -unlikes
    Route::post('like_unlike_post/{post_id}',[likeController::class,'store']);
    //friend 
    Route::post('friend',[friendController::class,'store']);
    //////////////////////////////////////////
    //azkar
    Route::get('azkar',[azkarController::class,'index']);
    Route::post('azkar',[azkarController::class,'store']);
    //Route::get('azkar/{id}',[azkarController::class,'show']);
    Route::put('azkar/{id}/edit',[azkarController::class,'update']);
    Route::delete('azkar/{id}/delete',[azkarController::class,'destroy']);
    //hadith
    Route::get('hadith',[hadithController::class,'index']);
    Route::post('hadith',[hadithController::class,'store']);
    //Route::get('hadith/{id}',[hadithController::class,'show']);
    Route::put('hadith/{id}/edit',[hadithController::class,'update']);
    Route::delete('hadith/{id}/delete',[hadithController::class,'destroy']);
    //doaa
    Route::get('doaa',[doaaController::class,'index']);
    Route::post('doaa',[doaaController::class,'store']);
    //Route::get('post/{id}',[doaaController::class,'show']);
    Route::put('doaa/{id}/edit',[doaaController::class,'update']);
    Route::delete('doaa/{id}/delete',[doaaController::class,'destroy']);
    //search user
    Route::post('search',[searchController::class,'search']);
    //searchContent 
    Route::post('advancedSearch',[searchController::class,'advancedSearch']);
    //

});
