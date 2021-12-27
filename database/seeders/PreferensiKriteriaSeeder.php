<?php

namespace Database\Seeders;

use App\Models\Emiten;
use App\Models\IndexSaham;
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
        $indexs = IndexSaham::get();
        foreach ($indexs as $index) {
            $preferensis = Preferensi::where('index_id', '=', $index->id)->get();
            $emitens = Emiten::where('index_id', '=', $index->id)->get();
            foreach ($emitens as $emiten) {
                foreach ($preferensis as $preferensi) {
                    if ($emiten['eps'] < $preferensi['avg_bawah_eps'] && $emiten['eps'] >= $preferensi['min_eps']) {
                        $eps_pk = 1;
                    } elseif ($emiten['eps'] < $preferensi['mean_eps'] && $emiten['eps'] >= $preferensi['avg_bawah_eps']) {
                        $eps_pk = 2;
                    } elseif ($emiten['eps'] < $preferensi['avg_atas_eps'] && $emiten['eps'] >= $preferensi['mean_eps']) {
                        $eps_pk = 3;
                    } elseif ($emiten['eps'] <= $preferensi['max_eps'] && $emiten['eps'] > $preferensi['avg_atas_eps']) {
                        $eps_pk = 4;
                    }
    
                    if ($emiten['roe'] < $preferensi['avg_bawah_roe'] && $emiten['roe'] >= $preferensi['min_roe']) {
                        $roe_pk = 1;
                    } elseif ($emiten['roe'] < $preferensi['mean_roe'] && $emiten['roe'] >= $preferensi['avg_bawah_roe']) {
                        $roe_pk = 2;
                    } elseif ($emiten['roe'] < $preferensi['avg_atas_roe'] && $emiten['roe'] >= $preferensi['mean_roe']) {
                        $roe_pk = 3;
                    } elseif ($emiten['roe'] <= $preferensi['max_roe'] && $emiten['roe'] > $preferensi['avg_atas_roe']) {
                        $roe_pk = 4;
                    }
    
                    if ($emiten['per'] < $preferensi['avg_bawah_per'] && $emiten['per'] >= $preferensi['min_per']) {
                        $per_pk = 1;
                    } elseif ($emiten['per'] < $preferensi['mean_per'] && $emiten['per'] >= $preferensi['avg_bawah_per']) {
                        $per_pk = 2;
                    } elseif ($emiten['per'] < $preferensi['avg_atas_per'] && $emiten['per'] >= $preferensi['mean_per']) {
                        $per_pk = 3;
                    } elseif ($emiten['per'] <= $preferensi['max_per'] && $emiten['per'] > $preferensi['avg_atas_per']) {
                        $per_pk = 4;
                    }
    
                    if ($emiten['der'] < $preferensi['avg_bawah_der'] && $emiten['der'] >= $preferensi['min_der']) {
                        $der_pk = 1;
                    } elseif ($emiten['der'] < $preferensi['mean_der'] && $emiten['der'] >= $preferensi['avg_bawah_der']) {
                        $der_pk = 2;
                    } elseif ($emiten['der'] < $preferensi['avg_atas_der'] && $emiten['der'] >= $preferensi['mean_der']) {
                        $der_pk = 3;
                    } elseif ($emiten['der'] <= $preferensi['max_der'] && $emiten['der'] > $preferensi['avg_atas_der']) {
                        $der_pk = 4;
                    }
    
                    DB::table('preferensi_kriterias')->insert([
                        'emiten_id' => $emiten->id,
                        'eps_pk' => $eps_pk,
                        'roe_pk' => $roe_pk,
                        'per_pk' => $per_pk,
                        'der_pk' => $der_pk,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    
                }
            }
        }

        // $preferensis_syars = Preferensi::where('index_id', '=', 2)->get();
        // $emiten_syars = Emiten::where('index_id', '=', 2)->get();
        // foreach ($emiten_syars as $emiten_syar) {
        //     foreach ($preferensis_syars as $preferensis_syar) {
        //         if ($emiten_syar['eps'] < $preferensis_syar['avg_bawah_eps'] && $emiten_syar['eps'] >= $preferensis_syar['min_eps']) {
        //             $eps_pk_syar = 1;
        //         } elseif ($emiten_syar['eps'] < $preferensis_syar['mean_eps'] && $emiten_syar['eps'] >= $preferensis_syar['avg_bawah_eps']) {
        //             $eps_pk_syar = 2;
        //         } elseif ($emiten_syar['eps'] < $preferensis_syar['avg_atas_eps'] && $emiten_syar['eps'] >= $preferensis_syar['mean_eps']) {
        //             $eps_pk_syar = 3;
        //         } elseif ($emiten_syar['eps'] <= $preferensis_syar['max_eps'] && $emiten_syar['eps'] > $preferensis_syar['avg_atas_eps']) {
        //             $eps_pk_syar = 4;
        //         }

        //         if ($emiten_syar['roe'] < $preferensis_syar['avg_bawah_roe'] && $emiten_syar['roe'] >= $preferensis_syar['min_roe']) {
        //             $roe_pk_syar = 1;
        //         } elseif ($emiten_syar['roe'] < $preferensis_syar['mean_roe'] && $emiten_syar['roe'] >= $preferensis_syar['avg_bawah_roe']) {
        //             $roe_pk_syar = 2;
        //         } elseif ($emiten_syar['roe'] < $preferensis_syar['avg_atas_roe'] && $emiten_syar['roe'] >= $preferensis_syar['mean_roe']) {
        //             $roe_pk_syar = 3;
        //         } elseif ($emiten_syar['roe'] <= $preferensis_syar['max_roe'] && $emiten_syar['roe'] > $preferensis_syar['avg_atas_roe']) {
        //             $roe_pk_syar = 4;
        //         }

        //         if ($emiten_syar['per'] < $preferensis_syar['avg_bawah_per'] && $emiten_syar['per'] >= $preferensis_syar['min_per']) {
        //             $per_pk_syar = 1;
        //         } elseif ($emiten_syar['per'] < $preferensis_syar['mean_per'] && $emiten_syar['per'] >= $preferensis_syar['avg_bawah_per']) {
        //             $per_pk_syar = 2;
        //         } elseif ($emiten_syar['per'] < $preferensis_syar['avg_atas_per'] && $emiten_syar['per'] >= $preferensis_syar['mean_per']) {
        //             $per_pk_syar = 3;
        //         } elseif ($emiten_syar['per'] <= $preferensis_syar['max_per'] && $emiten_syar['per'] > $preferensis_syar['avg_atas_per']) {
        //             $per_pk_syar = 4;
        //         }

        //         if ($emiten_syar['der'] < $preferensis_syar['avg_bawah_der'] && $emiten_syar['der'] >= $preferensis_syar['min_der']) {
        //             $der_pk_syar = 1;
        //         } elseif ($emiten_syar['der'] < $preferensis_syar['mean_der'] && $emiten_syar['der'] >= $preferensis_syar['avg_bawah_der']) {
        //             $der_pk_syar = 2;
        //         } elseif ($emiten_syar['der'] < $preferensis_syar['avg_atas_der'] && $emiten_syar['der'] >= $preferensis_syar['mean_der']) {
        //             $der_pk_syar = 3;
        //         } elseif ($emiten_syar['der'] <= $preferensis_syar['max_der'] && $emiten_syar['der'] > $preferensis_syar['avg_atas_der']) {
        //             $der_pk_syar = 4;
        //         }

        //         DB::table('preferensi_kriterias')->insert([
        //             'emiten_id' => $emiten_syar->id,
        //             'eps_pk' => $eps_pk_syar,
        //             'roe_pk' => $roe_pk_syar,
        //             'per_pk' => $per_pk_syar,
        //             'der_pk' => $der_pk_syar,
        //             'created_at' => now(),
        //             'updated_at' => now()
        //         ]);
                
        //     }
        // }

    }
}
