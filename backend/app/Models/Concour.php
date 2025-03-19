<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Domaine;
use App\Models\Administration;
use Illuminate\Database\Eloquent\Model;

class Concour extends Model
{
    protected $fillable = [
        'administration_id', 'domaine_id', 'grade_id', 'counc_name','conc_pdf','generated_name','concour_pdf_correction','generated_name_corr','is_corrected','feedback','submitted_at'
    ];
    protected $table= "concours";
    protected $hidden = ["id"];


    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function administration()
    {
        return $this->belongsTo(Administration::class);
    }

    public function domain()
    {
        return $this->belongsTo(Domaine::class);
    }

}
