<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Azkar;
use App\Models\Doaa;
use App\Models\Hadith;
use App\Models\User;
use Illuminate\Http\Request;

class searchController extends Controller

{
    public function search (Request $Request){
        $name=$Request ->get('search');
        $searchName=User::Select("*")->orderby("name","ASC")->where('name','like','%'.$name.'%')->get(); 
        return response()->json([
            'stetus'=>200,
            'user'=>$searchName
        ],200);
        
    }

    public function advancedSearch (Request $Request){
        $content=$Request->get('search');

        $searchContent = [];
        $azkar = Azkar::select('*')
        ->where('content','like','%'.$content.'%')->get();

        $hadith = Hadith::select('*')
        ->where('content','like','%'.$content.'%')->get();

        $doaa = Doaa::select('*')
        ->where('content','like','%'.$content.'%')->get();

        $searchContent = [
        'configs'=> $azkar,
        'hadith' => $hadith,
        'doaa'  => $doaa
        ];
        return response()->json([
            'stetus'=>200,
            'user'=>$searchContent
        ],200);            
    }
}
