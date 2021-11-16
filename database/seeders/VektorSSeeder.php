<?php

namespace Database\Seeders;

use App\Models\Bobot;
use App\Models\Emiten;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VektorSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emiten_kons = Emiten::where('index_id', 1)->get();
        $bobots = Bobot::where('instrument_saham_id', '=', 1)->get();
        foreach ($emiten_kons as $emiten_kon) {
            foreach ($bobots as $bobot) {
                $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], -$bobot['w_eps']);
                $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], $bobot['w_roe']);
                $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], $bobot['w_per']);
                $w_total = $w_eps * $w_roe * $w_per;
                // echo $emiten_kon['emiten_char'] . ' ' .  $w_total . '<br>';
                DB::table('vektor_s')->insert([
                    'emiten_id' => $emiten_kon->id,
                    'vektor_s' => $w_total,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        $emiten_syars = Emiten::where('index_id', 2)->get();
        $bobots = Bobot::where('instrument_saham_id', '=', 2)->get();
        foreach ($emiten_syars as $emiten_syar) {
            foreach ($bobots as $bobot) {
                $w_eps = pow($emiten_syar->prefereni_kriteria['eps_pk'], $bobot['w_eps']);
                $w_roe = pow($emiten_syar->prefereni_kriteria['roe_pk'], $bobot['w_roe']);
                $w_der = pow($emiten_syar->prefereni_kriteria['der_pk'], $bobot['w_der']);
                $w_total = $w_eps * $w_roe * $w_der;
                // echo $emiten_syar['emiten_char'] . ' ' .  $w_total . '<br>';
                DB::table('vektor_s')->insert([
                    'emiten_id' => $emiten_syar->id,
                    'vektor_s' => $w_total,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
