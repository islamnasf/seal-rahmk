<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendPost extends Model
{
    use HasFactory;
    protected $table='friend_posts';
    protected $fillable=['friend_id','post_id'];
    function posts(){
        return $this->belongsTo('App\Models\Post','post_id','id');
    }
    function friends(){
        return $this->belongsTo('App\Models\Friend','friend_id','id');
    }

}
