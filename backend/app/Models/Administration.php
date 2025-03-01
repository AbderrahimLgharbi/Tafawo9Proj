<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    protected $fillable=['id','administration_name'];
    protected $table= "administrations";
    protected $hidden = ["created_at","id"];
    // public $timestamps = false;


}


