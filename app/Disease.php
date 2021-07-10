<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    public $timestamps = FALSE;

    public function symptoms()
    {
        return $this->belongsToMany('App\Symptom', 'disease_symptom');
    }
}
