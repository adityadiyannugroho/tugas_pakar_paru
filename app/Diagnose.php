<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnose extends Model
{
    public $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function diseases()
    {
        return $this->belongsToMany('App\Disease', 'diagnose_disease')
            ->withPivot('score');
    }

    public function symptoms()
    {
        return $this->belongsToMany('App\Symptom', 'diagnose_symptom');
    }
}
