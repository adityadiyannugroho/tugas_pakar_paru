<?php

namespace App\Http\Controllers;

use App\Symptom;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $symptoms = new Symptom;

        $search_query = $request->input('q');
        if ($search_query) {
            $symptoms = $symptoms::where('name', 'like', "%$search_query%");
            $symptoms = $symptoms->paginate(15);
        } else {
            $symptoms = $symptoms::paginate(15);
        }

        return view('symptom.index', ['symptoms' => $symptoms]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = $request->validate([
            'name' => 'required|max:65535',
            'weight' => 'required|gt:0|numeric|max:1',
        ]);

        $s = new Symptom;
        $s->name = $v['name'];
        $s->weight = $v['weight'];
        $s->save();

        return redirect()->back()
            ->with('alert', [
                'type' => 'success',
                'message' => 'Gejala berhasil ditambahkan'
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Symptom $symptom)
    {
        $v = $request->validate([
            'name' => 'required|max:65535',
            'weight' => 'required|gt:0|numeric|max:1',
        ]);

        $symptom->name = $v['name'];
        $symptom->weight = $v['weight'];
        $symptom->save();

        return redirect()->back()
            ->with('alert', [
                'type' => 'success',
                'message' => "Gejala $symptom->id berhasil diubah"
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Symptom $symptom)
    {
        $symptom->delete();
        return redirect()->back()
            ->with('alert', [
                'type' => 'success',
                'message' => 'Gejala berhasil dihapus'
            ]);
    }
}
