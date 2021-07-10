<?php

namespace App\Http\Controllers;

use App\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Disease::class, 'disease');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diseases = Disease::paginate(10);

        return view('disease.index', ['diseases' => $diseases]);
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
            'name' => 'required|max:65535'
        ]);

        $d = new Disease;
        $d->name = $v['name'];
        $d->save();

        return redirect()->back()
            ->with('alert', [
                'type' => 'success',
                'message' => 'Penyakit berhasil ditambahkan'
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disease $disease)
    {
        $v = $request->validate([
            'name' => 'required|max:65535'
        ]);

        $disease->name = $v['name'];
        $disease->save();

        return redirect()->back()
            ->with('alert', [
                'type' => 'success',
                'message' => 'Nama penyakit berhasil diubah'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disease $disease)
    {
        $disease->delete();
        return redirect()->back()
            ->with('alert', [
                'type' => 'success',
                'message' => 'Semua hal yang berkaitan dengan penyakit tersebut berhasil dihapus'
            ]);
    }
}
