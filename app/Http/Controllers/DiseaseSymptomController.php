<?php

namespace App\Http\Controllers;

use App\Disease;
use App\DiseaseSymptom;
use Illuminate\Http\Request;

class DiseaseSymptomController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(DiseaseSymptom::class, 'disease_symptom');
    }

    public function index()
    {
        $diseases = Disease::paginate(15);

        return view('disease.symptom.index', ['diseases' => $diseases]);
    }

    public function edit(Disease $diseaseSymptom)
    {
        return view('disease.symptom.edit', ['disease' => $diseaseSymptom]);
    }

    public function update(Request $request, Disease $diseaseSymptom)
    {
        $v = $request->validate([
            'symptom' => 'required|exists:symptoms,id'
        ]);

        $diseaseSymptom->symptoms()->sync($v['symptom']);

        return redirect('/disease-symptom')
            ->with('alert', [
                'type' => 'success',
                'message' => 'Hubungan gejala berhasil disimpan'
            ]);
    }
}
