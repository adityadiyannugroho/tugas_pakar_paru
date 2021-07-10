<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'PageController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('diagnose', 'DiagnoseController');
    Route::resource('disease', 'DiseaseController');
    Route::resource('symptom', 'SymptomController');
    Route::resource('disease-symptom', 'DiseaseSymptomController');

    Route::get('diagnose/{diagnose_id}/symptom/{symptom_id}', 'DiagnoseSymptomController@create');
    Route::post('diagnose/{diagnose_id}/symptom/{symptom_id}', 'DiagnoseSymptomController@store');

    Route::get('/api/symptoms', function (Request $request) {
        $disease_id = $request->input('disease_id');

        if ($disease_id != NULL) {
            return \App\Disease::find($disease_id)
                ->symptoms()
                ->get()
                ->toArray();
        } else {
            return abort(404);
        }
    });
});


