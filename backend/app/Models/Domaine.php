<?php

namespace App\Models;

use App\Models\Concour;
use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    protected $fillable=['id','domain_name'];
    protected $table= "domaines";
    protected $hidden = ["id"];

    public function concours(){
        return $this->hasMany(Concour::class);
    }
}
