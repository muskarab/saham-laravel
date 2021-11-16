<?php

namespace Database\Seeders;

use App\Models\Emiten;
use App\Models\VektorS;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VektorVSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sum_vektor_s_kon = DB::table('emitens')
        ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
        ->where('index_id', 1)
        ->select('vektor_s.vektor_s')
        ->sum('vektor_s.vektor_s');
        // echo $sum_vektor_s_kon;
        $emiten_kons = Emiten::where('index_id', 1)->get();
        foreach ($emiten_kons as $emiten_kon) {
            DB::table('vektor_v')->insert([
                'emiten_id' => $emiten_kon->id,
                'vektor_v' => $emiten_kon->vektor_s['vektor_s'] / $sum_vektor_s_kon,
            ]);
        }

        $sum_vektor_s_syar = DB::table('emitens')
        ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
        ->where('index_id', 2)
        ->select('vektor_s.vektor_s')
        ->sum('vektor_s.vektor_s');
        // echo $sum_vektor_s_syar;
        $emiten_syars = Emiten::where('index_id', 2)->get();
        foreach ($emiten_syars as $emiten_syar) {
            DB::table('vektor_v')->insert([
                'emiten_id' => $emiten_syar->id,
                'vektor_v' => $emiten_syar->vektor_s['vektor_s'] / $sum_vektor_s_syar,
            ]);
        }

    }
}
