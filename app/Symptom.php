<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    public $timestamps = FALSE;

    public function diseases()
    {
        return $this->belongsToMany('App\Disease', 'disease_symptom');
    }
}
