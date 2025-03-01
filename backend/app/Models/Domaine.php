<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    protected $fillable=['id','domain_name'];
    protected $table= "domaines";
    protected $hidden = ["id"];
}
