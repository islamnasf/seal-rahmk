<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;
    public $table="friends";
    function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    protected $fillable=['id','user_requested','user_id','stutes'];
    public function posts(){
        return $this->belongsToMany(Post::class, 'friend_posts', 'friend_id', 'post_id')
        ->withTimestamps();  
      }

}
