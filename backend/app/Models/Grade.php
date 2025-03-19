<?php

namespace App\Models;

use App\Models\Concour;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable=['id','grade_name'];
    protected $table= "grades";
    protected $hidden = ["created_at"];

    public function concours()
    {
        return $this->hasMany(Concour::class);
    }
}
