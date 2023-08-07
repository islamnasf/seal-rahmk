<?php

namespace App\Models;
use App\Models\User;
use App\Models\Comment;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $table="posts";
    public function comments(){
        return $this->hasMany('App\Models\Comment','post_id','id');

    }
    public function likes(){
        return $this->hasMany('App\Models\Like','post_id','id');
    }
    public function users(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    protected $fillable=['id','user_id','content','image','status'];
    public function friends(){
        return $this->belongsToMany(Friend::class, 'friend_posts', 'post_id', 'friend_id')->withTimestamps();  
      }

    public function families(){
        return $this->belongsToMany(Family::class, 'family_posts', 'post_id', 'family_id')->withTimestamps();
    }
      public  function getImageAttribute()
    {
        return isset($this->attributes['image']) ? asset($this->attributes['image']) : asset('');
    }
}
