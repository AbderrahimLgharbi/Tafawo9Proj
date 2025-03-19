<?php

namespace App\Models;

use App\Models\Concour;
use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    protected $fillable=['id','administration_name'];
    protected $table= "administrations";
    protected $hidden = ["created_at"];
    // public $timestamps = false;

    public function concours()
    {
        return $this->hasMany(Concour::class);
    }
}


