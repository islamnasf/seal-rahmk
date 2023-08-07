<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doaa extends Model
{
    use HasFactory;
    public $table="doaas";

    protected $fillable=['id','name','content'];
}
