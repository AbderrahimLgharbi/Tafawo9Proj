<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concour extends Model
{
    protected $fillable=['id','counc_name'];
    protected $table= "concours";
    protected $hidden = ["id"];
}
