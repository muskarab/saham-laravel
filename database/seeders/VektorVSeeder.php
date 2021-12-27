<?php

namespace Database\Seeders;

use App\Models\Emiten;
use App\Models\IndexSaham;
use App\Models\User;
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
        $users = User::get();
        $indexs = IndexSaham::get();
        foreach ($users as $user) {
            // if ($user->instrument_saham_id == 1) {
                foreach ($indexs as $index) {
                    $sum_vektor_s_kon = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                    ->where('index_sahams.id', $index->id)
                    ->where('vektor_s.user_id', $user->id)
                    ->select('vektor_s.vektor_s')
                    ->sum('vektor_s.vektor_s');
                    $vektor_s_kons = DB::table('emitens')
                    ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
                    ->join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
                    ->where('index_sahams.id', $index->id)
                    ->where('vektor_s.user_id', $user->id)
                    ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
                    ->get();
                    foreach ($vektor_s_kons as $vektor_s_kon) {
                        DB::table('vektor_v_s')->insert([
                            'user_id' => $user->id,
                            'emiten_id' => $vektor_s_kon->id,
                            'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                }
            // }
            
            // if ($user->instrument_saham_id == 2) {
            //     $sum_vektor_s_syar = DB::table('emitens')
            //         ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
            //         ->where('index_id', 2)
            //         ->where('vektor_s.user_id', $user->id)
            //         ->select('vektor_s.vektor_s')
            //         ->sum('vektor_s.vektor_s');
            //     $vektor_s_syars = DB::table('emitens')
            //         ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
            //         ->where('index_id', 2)
            //         ->where('vektor_s.user_id', $user->id)
            //         ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
            //         ->get();
            //     foreach ($vektor_s_syars as $vektor_s_syar) {
            //         DB::table('vektor_v_s')->insert([
            //             'user_id' => $user->id,
            //             'emiten_id' => $vektor_s_syar->id,
            //             'vektor_v' => $vektor_s_syar->vektor_s / $sum_vektor_s_syar,
            //             'created_at' => now(),
            //             'updated_at' => now()
            //         ]);
            //     }
            // }

            // if ($user->instrument_saham_id == 3) {
            //     $sum_vektor_s_kon = DB::table('emitens')
            //         ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
            //         ->where('index_id', 1)
            //         ->where('vektor_s.user_id', $user->id)
            //         ->select('vektor_s.vektor_s')
            //         ->sum('vektor_s.vektor_s');
            //     $vektor_s_kons = DB::table('emitens')
            //         ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
            //         ->where('index_id', 1)
            //         ->where('vektor_s.user_id', $user->id)
            //         ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
            //         ->get();
            //     foreach ($vektor_s_kons as $vektor_s_kon) {
            //         DB::table('vektor_v_s')->insert([
            //             'user_id' => $user->id,
            //             'emiten_id' => $vektor_s_kon->id,
            //             'vektor_v' => $vektor_s_kon->vektor_s / $sum_vektor_s_kon,
            //             'created_at' => now(),
            //             'updated_at' => now()
            //         ]);
            //     }
            //     $sum_vektor_s_syar = DB::table('emitens')
            //         ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
            //         ->where('index_id', 2)
            //         ->where('vektor_s.user_id', $user->id)
            //         ->select('vektor_s.vektor_s')
            //         ->sum('vektor_s.vektor_s');
            //     $vektor_s_syars = DB::table('emitens')
            //         ->join('vektor_s', 'emitens.id', '=', 'vektor_s.emiten_id')
            //         ->where('index_id', 2)
            //         ->where('vektor_s.user_id', $user->id)
            //         ->select('emitens.*', 'vektor_s.user_id', 'vektor_s.vektor_s')
            //         ->get();
            //     foreach ($vektor_s_syars as $vektor_s_syar) {
            //         DB::table('vektor_v_s')->insert([
            //             'user_id' => $user->id,
            //             'emiten_id' => $vektor_s_syar->id,
            //             'vektor_v' => $vektor_s_syar->vektor_s / $sum_vektor_s_syar,
            //             'created_at' => now(),
            //             'updated_at' => now()
            //         ]);
            //     }
            // }
        }
    }
}
