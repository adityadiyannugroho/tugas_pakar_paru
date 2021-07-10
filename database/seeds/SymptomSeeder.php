<?php

use App\Symptom;
use Illuminate\Database\Seeder;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $symptoms = [
            ['Demam sampai tubuh merasa mengigil', .45],
            ['Penurunan suhu tubuh sehingga bisa terjadi hipotermia', .09],
            ['Batuk berdahak dan dahak lebih kental dari biasanya', .45],
            ['Rasa sakit di dada saat menarik nafas dalam-dalam', .6],
            ['Nafas menjadi lebih cepat ', .36],
            ['Nyeri otot walau tidak mengerjakan pekerjaan berat', .38],
            ['Mengalami penyakit diare', .48],
            ['Mengalami sakit kepala atau pusing', .09],
            ['Kulit berubah menjadi warna biru', .18],
            ['Rasa haus berkurang', .3],
            ['Konvulsi', .49],
            ['Muntah-muntah yang menetap', .19],
            ['Penurunan tingkat kesadaran', .22],
            ['Nyeri pada persendian', .13],
            ['Tubuh merasa lemah', .45],
            ['Batuk kering', .36],
            ['Batuk keluar darah', .27],
            ['Mengalami sesak nafas', .63],
            ['Cegukan', .29],
            ['Berat badan yang menurun', .45],
            ['Demam dan berkeringat di malam hari', .6],
            ['Kehilangan nafsu makan', .15],
            ['Nafas pendek', .09],
            ['Denyut jantung yang cepat', .18],
            ['Tekanan darah rendah', .09],
            ['Mengalami stres, tegang dan rasa cemas yang berlebihan', .18],
            ['Bersin-bersin', .09],
            ['Hidung mampet dan hidung meler', .18],
            ['Gatal gatal pada tenggorokan', .09],
            ['Susah tidur ', .21],
            ['Nafas berat yang berbunyi "ngik"', .09],
            ['Nafas tersengal-sengal', .09],
            ['Dahak berwarna bening, putih, kuning atau kehijauan', .18],
            ['Tenggorokan merasa sakit', .09],
            ['Bengkak pada bagian kaki', .18],
            ['Deformitas jari ', .09],
            ['Pembengkakan di area wajah', .09],
            ['Kesulitan menelan', .09],
            ['Mengalami darah tinggi ', .09],
            ['Paru-paru terasa tertekan', .09],
            ['Mengi', .09],
            ['Bibir atau ujung jari membiru', .09],
            ['Sering mengalami infeksi pernafasan', .09],
            ['Mengalami batuk kronis', .09],
        ];

        foreach ($symptoms as $s) {
            factory(Symptom::class)->create([
                'name' => $s[0],
                'weight' => $s[1]
            ]);
        }
    }
}
