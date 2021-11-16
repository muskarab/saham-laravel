<?php

namespace Database\Seeders;

use App\Models\Emiten;
use App\Models\Preferensi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreferensiKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $preferensis_kons = Preferensi::where('index_id', '=', 1)->get();
        $emiten_kons = Emiten::where('index_id', '=', 1)->get();
        foreach ($emiten_kons as $emiten_kon) {
            foreach ($preferensis_kons as $preferensis_kon) {
                if ($emiten_kon['eps'] < $preferensis_kon['avg_bawah_eps'] && $emiten_kon['eps'] >= $preferensis_kon['min_eps']) {
                    $eps_pk_kon = 1;
                } elseif ($emiten_kon['eps'] < $preferensis_kon['mean_eps'] && $emiten_kon['eps'] >= $preferensis_kon['avg_bawah_eps']) {
                    $eps_pk_kon = 2;
                } elseif ($emiten_kon['eps'] < $preferensis_kon['avg_atas_eps'] && $emiten_kon['eps'] >= $preferensis_kon['mean_eps']) {
                    $eps_pk_kon = 3;
                } elseif ($emiten_kon['eps'] <= $preferensis_kon['max_eps'] && $emiten_kon['eps'] > $preferensis_kon['avg_atas_eps']) {
                    $eps_pk_kon = 4;
                }

                if ($emiten_kon['roe'] < $preferensis_kon['avg_bawah_roe'] && $emiten_kon['roe'] >= $preferensis_kon['min_roe']) {
                    $roe_pk_kon = 1;
                } elseif ($emiten_kon['roe'] < $preferensis_kon['mean_roe'] && $emiten_kon['roe'] >= $preferensis_kon['avg_bawah_roe']) {
                    $roe_pk_kon = 2;
                } elseif ($emiten_kon['roe'] < $preferensis_kon['avg_atas_roe'] && $emiten_kon['roe'] >= $preferensis_kon['mean_roe']) {
                    $roe_pk_kon = 3;
                } elseif ($emiten_kon['roe'] <= $preferensis_kon['max_roe'] && $emiten_kon['roe'] > $preferensis_kon['avg_atas_roe']) {
                    $roe_pk_kon = 4;
                }

                if ($emiten_kon['per'] < $preferensis_kon['avg_bawah_per'] && $emiten_kon['per'] >= $preferensis_kon['min_per']) {
                    $per_pk_kon = 1;
                } elseif ($emiten_kon['per'] < $preferensis_kon['mean_per'] && $emiten_kon['per'] >= $preferensis_kon['avg_bawah_per']) {
                    $per_pk_kon = 2;
                } elseif ($emiten_kon['per'] < $preferensis_kon['avg_atas_per'] && $emiten_kon['per'] >= $preferensis_kon['mean_per']) {
                    $per_pk_kon = 3;
                } elseif ($emiten_kon['per'] <= $preferensis_kon['max_per'] && $emiten_kon['per'] > $preferensis_kon['avg_atas_per']) {
                    $per_pk_kon = 4;
                }

                if ($emiten_kon['der'] < $preferensis_kon['avg_bawah_der'] && $emiten_kon['der'] >= $preferensis_kon['min_der']) {
                    $der_pk_kon = 1;
                } elseif ($emiten_kon['der'] < $preferensis_kon['mean_der'] && $emiten_kon['der'] >= $preferensis_kon['avg_bawah_der']) {
                    $der_pk_kon = 2;
                } elseif ($emiten_kon['der'] < $preferensis_kon['avg_atas_der'] && $emiten_kon['der'] >= $preferensis_kon['mean_der']) {
                    $der_pk_kon = 3;
                } elseif ($emiten_kon['der'] <= $preferensis_kon['max_der'] && $emiten_kon['der'] > $preferensis_kon['avg_atas_der']) {
                    $der_pk_kon = 4;
                }

                DB::table('preferensi_kriterias')->insert([
                    'emiten_id' => $emiten_kon->id,
                    'eps_pk' => $eps_pk_kon,
                    'roe_pk' => $roe_pk_kon,
                    'per_pk' => $per_pk_kon,
                    'der_pk' => $der_pk_kon,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
            }
        }

        $preferensis_syars = Preferensi::where('index_id', '=', 2)->get();
        $emiten_syars = Emiten::where('index_id', '=', 2)->get();
        foreach ($emiten_syars as $emiten_syar) {
            foreach ($preferensis_syars as $preferensis_syar) {
                if ($emiten_syar['eps'] < $preferensis_syar['avg_bawah_eps'] && $emiten_syar['eps'] >= $preferensis_syar['min_eps']) {
                    $eps_pk_syar = 1;
                } elseif ($emiten_syar['eps'] < $preferensis_syar['mean_eps'] && $emiten_syar['eps'] >= $preferensis_syar['avg_bawah_eps']) {
                    $eps_pk_syar = 2;
                } elseif ($emiten_syar['eps'] < $preferensis_syar['avg_atas_eps'] && $emiten_syar['eps'] >= $preferensis_syar['mean_eps']) {
                    $eps_pk_syar = 3;
                } elseif ($emiten_syar['eps'] <= $preferensis_syar['max_eps'] && $emiten_syar['eps'] > $preferensis_syar['avg_atas_eps']) {
                    $eps_pk_syar = 4;
                }

                if ($emiten_syar['roe'] < $preferensis_syar['avg_bawah_roe'] && $emiten_syar['roe'] >= $preferensis_syar['min_roe']) {
                    $roe_pk_syar = 1;
                } elseif ($emiten_syar['roe'] < $preferensis_syar['mean_roe'] && $emiten_syar['roe'] >= $preferensis_syar['avg_bawah_roe']) {
                    $roe_pk_syar = 2;
                } elseif ($emiten_syar['roe'] < $preferensis_syar['avg_atas_roe'] && $emiten_syar['roe'] >= $preferensis_syar['mean_roe']) {
                    $roe_pk_syar = 3;
                } elseif ($emiten_syar['roe'] <= $preferensis_syar['max_roe'] && $emiten_syar['roe'] > $preferensis_syar['avg_atas_roe']) {
                    $roe_pk_syar = 4;
                }

                if ($emiten_syar['per'] < $preferensis_syar['avg_bawah_per'] && $emiten_syar['per'] >= $preferensis_syar['min_per']) {
                    $per_pk_syar = 1;
                } elseif ($emiten_syar['per'] < $preferensis_syar['mean_per'] && $emiten_syar['per'] >= $preferensis_syar['avg_bawah_per']) {
                    $per_pk_syar = 2;
                } elseif ($emiten_syar['per'] < $preferensis_syar['avg_atas_per'] && $emiten_syar['per'] >= $preferensis_syar['mean_per']) {
                    $per_pk_syar = 3;
                } elseif ($emiten_syar['per'] <= $preferensis_syar['max_per'] && $emiten_syar['per'] > $preferensis_syar['avg_atas_per']) {
                    $per_pk_syar = 4;
                }

                if ($emiten_syar['der'] < $preferensis_syar['avg_bawah_der'] && $emiten_syar['der'] >= $preferensis_syar['min_der']) {
                    $der_pk_syar = 1;
                } elseif ($emiten_syar['der'] < $preferensis_syar['mean_der'] && $emiten_syar['der'] >= $preferensis_syar['avg_bawah_der']) {
                    $der_pk_syar = 2;
                } elseif ($emiten_syar['der'] < $preferensis_syar['avg_atas_der'] && $emiten_syar['der'] >= $preferensis_syar['mean_der']) {
                    $der_pk_syar = 3;
                } elseif ($emiten_syar['der'] <= $preferensis_syar['max_der'] && $emiten_syar['der'] > $preferensis_syar['avg_atas_der']) {
                    $der_pk_syar = 4;
                }

                DB::table('preferensi_kriterias')->insert([
                    'emiten_id' => $emiten_syar->id,
                    'eps_pk' => $eps_pk_syar,
                    'roe_pk' => $roe_pk_syar,
                    'per_pk' => $per_pk_syar,
                    'der_pk' => $der_pk_syar,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
            }
        }

    }
}
