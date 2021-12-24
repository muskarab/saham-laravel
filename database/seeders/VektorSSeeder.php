<?php

namespace Database\Seeders;

use App\Models\Bobot;
use App\Models\Emiten;
use App\Models\User;
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
        $users = User::get();
        $emiten_kons = Emiten::where('index_id', 1)->get();
        $emiten_syars = Emiten::where('index_id', 2)->get();
        foreach ($users as $user) {
            if ($user->instrument_saham_id == 1) {
                foreach ($emiten_kons as $emiten_kon) {
                    $w_user_total = $user->w_eps_kon + $user->w_roe_kon + $user->w_per_kon; 
                    $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], -($user['w_eps_kon'] / $w_user_total));
                    $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], ($user['w_roe_kon'] / $w_user_total));
                    $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], ($user['w_per_kon'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_per;
                    DB::table('vektor_s')->insert([
                        'emiten_id' => $emiten_kon->id,
                        'user_id' => $user->id,
                        'vektor_s' => $w_total,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }

            if ($user->instrument_saham_id == 2) {
                foreach ($emiten_syars as $emiten_syar) {
                    $w_user_total = $user->w_eps_syar + $user->w_roe_syar + $user->w_der_syar; 
                    $w_eps = pow($emiten_syar->prefereni_kriteria['eps_pk'], ($user['w_eps_syar'] / $w_user_total));
                    $w_roe = pow($emiten_syar->prefereni_kriteria['roe_pk'], ($user['w_roe_syar'] / $w_user_total));
                    $w_der = pow($emiten_syar->prefereni_kriteria['der_pk'], ($user['w_der_syar'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_der;
                    DB::table('vektor_s')->insert([
                        'emiten_id' => $emiten_syar->id,
                        'user_id' => $user->id,
                        'vektor_s' => $w_total,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }

            if ($user->instrument_saham_id == 3) {
                foreach ($emiten_kons as $emiten_kon) {
                    $w_user_total = $user->w_eps_kon + $user->w_roe_kon + $user->w_per_kon;
                    $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], - ($user['w_eps_kon'] / $w_user_total));
                    $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], ($user['w_roe_kon'] / $w_user_total));
                    $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], ($user['w_per_kon'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_per;
                    DB::table('vektor_s')->insert([
                        'emiten_id' => $emiten_kon->id,
                        'user_id' => $user->id,
                        'vektor_s' => $w_total,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
                foreach ($emiten_syars as $emiten_syar) {
                    $w_user_total = $user->w_eps_syar + $user->w_roe_syar + $user->w_der_syar; 
                    $w_eps = pow($emiten_syar->prefereni_kriteria['eps_pk'], ($user['w_eps_syar'] / $w_user_total));
                    $w_roe = pow($emiten_syar->prefereni_kriteria['roe_pk'], ($user['w_roe_syar'] / $w_user_total));
                    $w_der = pow($emiten_syar->prefereni_kriteria['der_pk'], ($user['w_der_syar'] / $w_user_total));
                    $w_total = $w_eps * $w_roe * $w_der;
                    DB::table('vektor_s')->insert([
                        'emiten_id' => $emiten_syar->id,
                        'user_id' => $user->id,
                        'vektor_s' => $w_total,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }
        // foreach ($emiten_kons as $emiten_kon) {
        //     foreach ($bobots as $bobot) {
        //         $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], -$bobot['w_eps']);
        //         $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], $bobot['w_roe']);
        //         $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], $bobot['w_per']);
        //         $w_total = $w_eps * $w_roe * $w_per;
        //         // echo $emiten_kon['emiten_char'] . ' ' .  $w_total . '<br>';
        //         DB::table('vektor_s')->insert([
        //             'emiten_id' => $emiten_kon->id,
        //             'vektor_s' => $w_total,
        //             'created_at' => now(),
        //             'updated_at' => now()
        //         ]);
        //     }
        // }

        // $emiten_syars = Emiten::where('index_id', 2)->get();
        // $bobots = Bobot::where('instrument_saham_id', '=', 2)->get();
        // foreach ($emiten_syars as $emiten_syar) {
        //     foreach ($bobots as $bobot) {
        //         $w_eps = pow($emiten_syar->prefereni_kriteria['eps_pk'], $bobot['w_eps']);
        //         $w_roe = pow($emiten_syar->prefereni_kriteria['roe_pk'], $bobot['w_roe']);
        //         $w_der = pow($emiten_syar->prefereni_kriteria['der_pk'], $bobot['w_der']);
        //         $w_total = $w_eps * $w_roe * $w_der;
        //         // echo $emiten_syar['emiten_char'] . ' ' .  $w_total . '<br>';
        //         DB::table('vektor_s')->insert([
        //             'emiten_id' => $emiten_syar->id,
        //             'vektor_s' => $w_total,
        //             'created_at' => now(),
        //             'updated_at' => now()
        //         ]);
        //     }
        // }
    }
}
