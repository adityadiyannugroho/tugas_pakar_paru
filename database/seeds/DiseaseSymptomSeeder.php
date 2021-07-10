<?php

use App\DiseaseSymptom;
use Illuminate\Database\Seeder;

class DiseaseSymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $symptom = [];

        for ($i=1; $i < 45; $i++) {
            $symptom[] = [
                'symptom_id' => $i,
                'disease_id' => []
            ];
        }

        $symptom[0]['diseases'] = [1,3,4,8,10];
        $symptom[1]['diseases'] = [1];
        $symptom[2]['diseases'] = [1,5,8,10,11];
        $symptom[3]['diseases'] = [1,2,3,4,5,7,8,11];
        $symptom[4]['diseases'] = [1,5,7,10];
        $symptom[5]['diseases'] = [1,2];
        $symptom[6]['diseases'] = [1,2];
        $symptom[7]['diseases'] = [1];
        $symptom[8]['diseases'] = [1,5];
        $symptom[9]['diseases'] = [1];
        $symptom[10]['diseases'] = [1];
        $symptom[11]['diseases'] = [1];
        $symptom[12]['diseases'] = [1];
        $symptom[13]['diseases'] = [2];
        $symptom[14]['diseases'] = [2,6,7,8,9];
        $symptom[15]['diseases'] = [2,3,4,6];
        $symptom[16]['diseases'] = [2,4,11];
        $symptom[17]['diseases'] = [2,3,6,7,9,10,11];
        $symptom[18]['diseases'] = [3];
        $symptom[19]['diseases'] = [4,7,9,10,11];
        $symptom[20]['diseases'] = [4];
        $symptom[21]['diseases'] = [4,9];
        $symptom[22]['diseases'] = [5];
        $symptom[23]['diseases'] = [5,7];
        $symptom[24]['diseases'] = [5];
        $symptom[25]['diseases'] = [5,9];
        $symptom[26]['diseases'] = [6];
        $symptom[27]['diseases'] = [6,8];
        $symptom[28]['diseases'] = [6];
        $symptom[29]['diseases'] = [6];
        $symptom[30]['diseases'] = [6];
        $symptom[31]['diseases'] = [6];
        $symptom[32]['diseases'] = [7,8];
        $symptom[33]['diseases'] = [8];
        $symptom[34]['diseases'] = [8,9];
        $symptom[35]['diseases'] = [11];
        $symptom[36]['diseases'] = [11];
        $symptom[37]['diseases'] = [11];
        $symptom[38]['diseases'] = [11];
        $symptom[39]['diseases'] = [3];
        $symptom[40]['diseases'] = [7];
        $symptom[41]['diseases'] = [7];
        $symptom[42]['diseases'] = [7];
        $symptom[43]['diseases'] = [9];

        foreach ($symptom as $ds) {
            foreach ($ds['diseases'] as $d) {
                factory(DiseaseSymptom::class)->create([
                    'symptom_id' => $ds['symptom_id'],
                    'disease_id' => $d,
                ]);
            }
        }
    }
}
