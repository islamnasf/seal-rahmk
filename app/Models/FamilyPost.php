<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyPost extends Model
{
    use HasFactory;
    protected $table='family_posts';
    protected $fillable=['family_id','post_id'];
    function posts(){
        return $this->belongsTo('App\Models\Post','post_id','id');
    }
    function families(){
        return $this->belongsTo('App\Models\Family','family_id','id');
    }

}
