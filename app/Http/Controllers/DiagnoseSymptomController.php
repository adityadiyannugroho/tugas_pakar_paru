<?php

namespace App\Http\Controllers;

use App\Diagnose;
use App\DiagnoseDisease;
use App\DiagnoseSymptom;
use App\Disease;
use App\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnoseSymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($diagnose_id, $symptom_id)
    {
        $user = Auth::user();
        $diagnose = Diagnose::findOrFail($diagnose_id);
        $symptom = Symptom::findOrFail($symptom_id);
        $previous_symptom = Symptom::find($symptom->id - 1);
        $next_symptom = Symptom::find($symptom->id + 1);

        if ($user->cant('edit', $diagnose))
            return abort(403);

        $diagnose->last_symptom_id = $symptom_id;
        $diagnose->save();

        return view('diagnose.symptom.create', [
            'diagnose' => $diagnose,
            'symptom' => $symptom,
            'previous_symptom' => $previous_symptom,
            'next_symptom' => $next_symptom,
            'last_symptom_id' => $symptom_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($diagnose_id, $symptom_id, Request $request)
    {
        $v = $request->validate([
            'condition' => 'required|boolean'
        ]);

        $user = Auth::user();

        $diagnose = Diagnose::findOrFail($diagnose_id);
        if ($user->cant('edit', $diagnose))
            return abort(403);

        Symptom::findOrFail($symptom_id);

        if ($v['condition'] == TRUE) {
            DiagnoseSymptom::firstOrCreate([
                'diagnose_id'=> $diagnose_id,
                'symptom_id'=> $symptom_id,
            ]);
        } else {
            $old_condition = DiagnoseSymptom::where([
                'diagnose_id'=> $diagnose_id,
                'symptom_id'=> $symptom_id,
            ]);

            if ($old_condition->exists()) {
                $old_condition->delete();
            }
        }

        $next_symptom = Symptom::find($symptom_id + 1);
        if ($next_symptom != null) {
            return redirect("diagnose/$diagnose_id/symptom/$next_symptom->id");
        }

        if ($diagnose->diseases()->count() == 0) {
            $matrix = [];
            $diseases = Disease::all();
            $symptoms = Symptom::all();

            $all_symptoms = $symptoms->toArray();
            $all_weights = [];

            // Semua bobot
            foreach ($all_symptoms as $as) {
                $all_weights[$as['id']] = $as['weight'];
            }

            // 1. Mengubah data ke dalam bentuk matriks
            foreach ($diseases as $d) {
                foreach ($symptoms as $s) {
                    if (
                        $d->symptoms()->find($s->id) != null
                        && DiagnoseSymptom::where([
                            'diagnose_id' => $diagnose->id,
                            'symptom_id' => $s->id
                        ])->exists()) {
                            $matrix[$s->id][$d->id] = 1;
                    } else {
                        $matrix[$s->id][$d->id] = 0;
                    }
                }
            }

            foreach ($matrix as $i => $m) {
                if (array_sum($m) == 0) {
                    unset($matrix[$i]);
                }
            }

            // 2. Menghitung matriks yang ternormalisasi
            foreach ($matrix as $i => $s) {
                $x = [];
                $mx = 0;

                foreach ($s as $d) {
                    $x[] = $d;
                }

                foreach ($x as $el) {
                    $mx += $el*$el;
                }

                $x_bottom = sqrt($mx);

                foreach ($s as $j => $d) {
                    $x_top = $d;
                    $matrix[$i][$j] = $x_top/$x_bottom;

                    // 3. Menghitung matriks yang ternomalisasi yang terbobot
                    $matrix[$i][$j] *= $all_weights[$i];
                }
            }

            $a_plus = [];
            $a_minus = [];
            $d_plus = [];
            $d_minus = [];

            // 4. Menentukan Solusi Ideal Positif (A+) dan Matriks Ideal Negatif (A-)
            foreach ($matrix as $i => $s) {
                $a_plus[$i] = max($s);
                $a_minus[$i] = min($s);
            }

            // Transpose Matrix
            foreach ($matrix as $i => $s) {
                foreach ($s as $j => $d) {
                    $result[$j][$i] = $d;
                }
            }

            // dd($a_plus);

            //TODO: 5. Menghitung Jarak Solusi Ideal Positif (D+) dan Solusi Ideal Negatif (D-)
            $d_plus = [];
            $d_minus = [];
            foreach ($result as $i => $d) {
                $ny_y = []; // komponen d+
                $n_yy = []; // komponen d-

                foreach ($d as $j => $s) { // $i undefined offset
                    $ny_y[] = ($a_plus[$j]-$s)**2;
                    $n_yy[] = ($a_minus[$j]-$s)**2;
                }

                $d_plus[$i] = sqrt(array_sum($ny_y));
                $d_minus[$i] = sqrt(array_sum($n_yy));
            }

            // 6. Menghitung Nilai Preferensi untuk setiap alternatif.
            $v = [];
            foreach ($result as $i => $d) {
                $v[$i] = $d_minus[$i]/($d_minus[$i] + $d_plus[$i]);

                DiagnoseDisease::create([
                    'diagnose_id' => $diagnose_id,
                    'disease_id' => $i,
                    'score' => round($v[$i], 2 , PHP_ROUND_HALF_UP)
                ]);
            }
        }

        return redirect("diagnose/$diagnose_id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DiagnoseSymptom  $diagnoseSymptom
     * @return \Illuminate\Http\Response
     */
    public function show(DiagnoseSymptom $diagnoseSymptom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DiagnoseSymptom  $diagnoseSymptom
     * @return \Illuminate\Http\Response
     */
    public function edit(DiagnoseSymptom $diagnoseSymptom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DiagnoseSymptom  $diagnoseSymptom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiagnoseSymptom $diagnoseSymptom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DiagnoseSymptom  $diagnoseSymptom
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiagnoseSymptom $diagnoseSymptom)
    {
        //
    }
}
