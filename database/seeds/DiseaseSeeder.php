<?php

use App\Disease;
use Illuminate\Database\Seeder;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diseases = [
            'Pneumonia',
            'Legionnaries',
            'Efusi Pluera',
            'Tuberkolosis (TB)',
            'Pneumotoraks',
            'Asma',
            'Obstruktif Kronis',
            'Bronkitis Kronis',
            'Emfisema',
            'Silikosis',
            'Asbestosis',
        ];

        foreach ($diseases as $s) {
            factory(Disease::class)->create([
                'name' => $s
            ]);
        }
    }
}
