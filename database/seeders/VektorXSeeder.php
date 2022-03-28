<?php

namespace Database\Seeders;

use App\Models\Emiten;
use App\Models\User;
use App\Models\IndexSaham;
use App\Models\Preferensi;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VektorXSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::get();
        $emitens = Emiten::get();
        $emitens_kon = Emiten::where( 'index_id','1')->get();
        $emitens_syar = Emiten::where('index_id','2')->get();
        $preferensis_kon = Preferensi::where('index_id','1')->get();
        $preferensis_syar = Preferensi::where('index_id','2')->get();

        $emiten_kons_x = Emiten::join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
        ->where('instrument_saham_id', 1)
        ->select('emitens.*', 'index_sahams.name')
        ->get();
        $emiten_syars_x = Emiten::join('index_sahams', 'emitens.index_id', '=', 'index_sahams.id')
        ->where('instrument_saham_id', 2)
        ->select('emitens.*', 'index_sahams.name')
        ->get();
        

    foreach ($users as $user) {

        $w_user_total_kon = $user->w_eps_kon + $user->w_roe_kon + $user->w_per_kon;
        $w_des_eps_kon = ($user['w_eps_kon'] / $w_user_total_kon);
        $w_des_roe_kon = ($user['w_roe_kon'] / $w_user_total_kon);
        $w_des_per_kon = ($user['w_per_kon'] / $w_user_total_kon);
        $w_des_der_kon = ($user['w_der_kon'] / $w_user_total_kon);
                
        $w_user_total_syar = $user->w_eps_syar + $user->w_roe_syar + $user->w_der_syar;
        $w_des_eps_syar = ($user['w_eps_syar'] / $w_user_total_syar);
        $w_des_roe_syar = ($user['w_roe_syar'] / $w_user_total_syar);
        $w_des_per_syar = ($user['w_per_syar'] / $w_user_total_syar);
        $w_des_der_syar = ($user['w_der_syar'] / $w_user_total_syar);

        
        foreach ($emitens_kon as $emiten_kon){
            foreach ($preferensis_kon as $preferensi_kon){
                
                $sim_atas_eps = ($emiten_kon['eps'] - $preferensi_kon['min_eps']);
                $sim_bawah_eps = ($preferensi_kon['max_eps'] - $preferensi_kon['min_eps']);
                $sim_3_eps = ($sim_atas_eps / $sim_bawah_eps) * 1000;
                $sim_4_eps_kon = $sim_3_eps * $w_des_eps_kon;

                $sim_atas_roe = ($emiten_kon['roe'] - $preferensi_kon['min_roe']);
                $sim_bawah_roe = ($preferensi_kon['max_roe'] - $preferensi_kon['min_roe']);
                $sim_3_roe = ($sim_atas_roe / $sim_bawah_roe) * 1000;
                $sim_4_roe_kon = $sim_3_roe * $w_des_roe_kon;

                $sim_atas_per = ($emiten_kon['per'] - $preferensi_kon['min_per']);
                $sim_bawah_per = ($preferensi_kon['max_per'] - $preferensi_kon['min_per']);
                $sim_3_per = ($sim_atas_per / $sim_bawah_per) * 1000;
                $sim_4_per_kon = $sim_3_per * $w_des_per_kon;

                $sim_atas_der = ($emiten_kon['der'] - $preferensi_kon['min_der']);
                $sim_bawah_der = ($preferensi_kon['max_der'] - $preferensi_kon['min_der']);
                $sim_3_der = ($sim_atas_der / $sim_bawah_der) * 1000;
                $sim_4_der_kon = $sim_3_der * $w_des_der_kon;

                DB::table('vektor_x')->insert([
                    'emiten_id' => $emiten_kon->id,
                    'user_id' => $user->id,
                    'sim_der_kon' => $sim_4_der_kon,
                    'sim_per_kon' => $sim_4_per_kon,
                    'sim_roe_kon' => $sim_4_roe_kon,
                    'sim_eps_kon' => $sim_4_eps_kon,
                    'sim_der_syar' => 0,
                    'sim_per_syar' => 0,
                    'sim_roe_syar' => 0,
                    'sim_eps_syar' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        foreach ($emitens_syar as $emiten_syar){
            foreach ($preferensis_syar as $preferensi_syar){
                $sim_atas_eps = ($emiten_syar['eps'] - $preferensi_syar['min_eps']);
                $sim_bawah_eps = ($preferensi_syar['max_eps'] - $preferensi_syar['min_eps']);
                $sim_3_eps = ($sim_atas_eps / $sim_bawah_eps) * 1000;
                $sim_4_eps_syar = $sim_3_eps * $w_des_eps_syar;

                $sim_atas_roe = ($emiten_syar['roe'] - $preferensi_syar['min_roe']);
                $sim_bawah_roe = ($preferensi_syar['max_roe'] - $preferensi_syar['min_roe']);
                $sim_3_roe = ($sim_atas_roe / $sim_bawah_roe) * 1000;
                $sim_4_roe_syar = $sim_3_roe * $w_des_roe_syar;

                $sim_atas_per = ($emiten_syar['per'] - $preferensi_syar['min_per']);
                $sim_bawah_per = ($preferensi_syar['max_per'] - $preferensi_syar['min_per']);
                $sim_3_per = ($sim_atas_per / $sim_bawah_per) * 1000;
                $sim_4_per_syar = $sim_3_per * $w_des_per_syar;

                $sim_atas_der = ($emiten_syar['der'] - $preferensi_syar['min_der']);
                $sim_bawah_der = ($preferensi_syar['max_der'] - $preferensi_syar['min_der']);
                $sim_3_der = ($sim_atas_der / $sim_bawah_der) * 1000;
                $sim_4_der_syar = $sim_3_der * $w_des_der_syar;

                DB::table('vektor_x')->insert([
                    'emiten_id' => $emiten_syar->id,
                    'user_id' => $user->id,
                    'sim_der_kon' => 0,
                    'sim_per_kon' => 0,
                    'sim_roe_kon' => 0,
                    'sim_eps_kon' => 0,
                    'sim_der_syar' => $sim_4_der_syar,
                    'sim_per_syar' => $sim_4_per_syar,
                    'sim_roe_syar' => $sim_4_roe_syar,
                    'sim_eps_syar' => $sim_4_eps_syar,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
                

                    
                        
                        // $sim_atas_eps = ($emiten['eps'] - $preferensi['min_eps']);
                        // $sim_bawah_eps = ($epreferensi['max_eps'] - $preferensi['min_eps']);
                        // $sim_3_eps = ($sim_atas_eps / $sim_bawah_eps) * 1000;
                        // $sim_4_eps = $sim_3_eps * $w_des_eps_syar;


                        // $sim_atas_roe = ($emiten['roe'] - $preferensi['min_roe']);
                        // $sim_bawah_roe = ($preferensi['max_roe'] - $preferensi['min_roe']);
                        // $sim_3_roe = ($sim_atas_roe / $sim_bawah_roe) * 1000;
                        // $sim_4_roe = $sim_3_roe * $w_des_roe_syar;


                        // $sim_atas_per = ($emiten['per'] - $preferensi['min_per']);
                        // $sim_bawah_per = ($preferensi['max_per'] - $preferensi['min_per']);
                        // $sim_3_per = ($sim_atas_per / $sim_bawah_per) * 1000;
                        // $sim_4_per = $sim_3_per * $w_des_per_syar;


                        // $sim_atas_der = ($emiten['der'] - $preferensi['min_der']);
                        // $sim_bawah_der = ($preferensi['max_der'] - $preferensi['min_der']);
                        // $sim_3_der = ($sim_atas_der / $sim_bawah_der) * 1000;
                        // $sim_4_der = $sim_3_der * $w_des_der_syar;

                        // DB::table('vektor_x')->insert([
                        //     'emiten_id' => $emiten_syar_x->id,
                        //     'user_id' => $user->id,
                        //     'sim_der_syar' => $sim_4_der,
                        //     'sim_per_syar' => $sim_4_per,
                        //     'sim_roe_syar' => $sim_4_roe,
                        //     'sim_eps_syar' => $sim_4_eps,
                        //     'created_at' => now(),
                        //     'updated_at' => now()
                        //     ]);
                       
                     
        
        }
    } 
}

//     {
//         $indexs = IndexSaham::get();
//         $users = User::get();
//         $emitens = Emiten::get();


//         foreach ($indexs as $index) {
//             $preferensis = Preferensi::where('index_id', '=', $index->id)->get();
//             $emitens = Emiten::where('index_id', '=', $index->id)->get();

//             foreach ($users as $user) {
//                 $w_user_total_kon = $user->w_eps_kon + $user->w_roe_kon + $user->w_per_kon;
//                 $w_des_eps_kon = ($user['w_eps_kon'] / $w_user_total_kon);
//                 $w_des_roe_kon = ($user['w_roe_kon'] / $w_user_total_kon);
//                 $w_des_per_kon = ($user['w_per_kon'] / $w_user_total_kon);
//                 $w_des_der_kon = ($user['w_der_kon'] / $w_user_total_kon);

//                 $w_user_total_syar = $user->w_eps_syar + $user->w_roe_syar + $user->w_der_syar;
//                 $w_des_eps_syar = ($user['w_eps_syar'] / $w_user_total_syar);
//                 $w_des_roe_syar = ($user['w_roe_syar'] / $w_user_total_syar);
//                 $w_des_per_syar = ($user['w_per_syar'] / $w_user_total_syar);
//                 $w_des_der_syar = ($user['w_der_syar'] / $w_user_total_syar);
                
//                 foreach ($emitens as $emiten) {

//                     foreach ($preferensis as $preferensi) {
                    
//                     $sim_atas_eps = ($emiten['eps'] - $preferensi['min_eps']);
//                     $sim_bawah_eps = ($preferensi['max_eps'] - $preferensi['min_eps']);
//                     $sim_atas_roe = ($emiten['roe'] - $preferensi['min_roe']);
//                     $sim_bawah_roe = ($preferensi['max_roe'] - $preferensi['min_roe']);
//                     $sim_atas_per = ($emiten['per'] - $preferensi['min_per']);
//                     $sim_bawah_per = ($preferensi['max_per'] - $preferensi['min_per']);
//                     $sim_atas_der = ($emiten['der'] - $preferensi['min_der']);
//                     $sim_bawah_der = ($preferensi['max_der'] - $preferensi['min_der']);

//                     $sim_3_eps_kon = ($sim_atas_eps / $sim_bawah_eps) * 1000;
//                     $sim_4_eps_kon = $sim_3_eps_kon * $w_des_eps_kon;
//                     $sim_3_roe_kon = ($sim_atas_roe / $sim_bawah_roe) * 1000;
//                     $sim_4_roe_kon = $sim_3_roe_kon * $w_des_roe_kon;
//                     $sim_3_per_kon = ($sim_atas_per / $sim_bawah_per) * 1000;
//                     $sim_4_per_kon = $sim_3_per_kon * $w_des_per_kon;
//                     $sim_3_der_kon = ($sim_atas_der / $sim_bawah_der) * 1000;
//                     $sim_4_der_kon = $sim_3_der_kon * $w_des_der_kon;

//                     $sim_3_eps_syar = ($sim_atas_eps / $sim_bawah_eps) * 1000;
//                     $sim_4_eps_syar = $sim_3_eps_syar * $w_des_eps_syar;
//                     $sim_3_roe_syar = ($sim_atas_roe / $sim_bawah_roe) * 1000;
//                     $sim_4_roe_syar = $sim_3_roe_syar * $w_des_roe_syar;
//                     $sim_3_per_syar = ($sim_atas_per / $sim_bawah_per) * 1000;
//                     $sim_4_per_syar = $sim_3_per_syar * $w_des_per_syar;
//                     $sim_3_der_syar = ($sim_atas_der / $sim_bawah_der) * 1000;
//                     $sim_4_der_syar = $sim_3_der_syar * $w_des_der_syar;
                    
//                     DB::table('vektor_x')->insert([
//                         'user_id' => $user->id,
//                         'emiten_id' => $emiten->id,
//                         'sim_der_kon' => $sim_4_der_kon,
//                         'sim_per_kon' => $sim_4_per_kon,
//                         'sim_roe_kon' => $sim_4_roe_kon,
//                         'sim_eps_kon' => $sim_4_eps_kon,
//                         'sim_der_syar' => $sim_4_der_syar,
//                         'sim_per_syar' => $sim_4_per_syar,
//                         'sim_roe_syar' => $sim_4_roe_syar,
//                         'sim_eps_syar' => $sim_4_eps_syar,
//                         'created_at' => now(),
//                         'updated_at' => now()
//                     ]);
//                     }



//                 }
//             }
//         }
//     }
// }




        // foreach ($users as $user) {foreach ($emiten_kons as $emiten_kon) {
        //             $w_user_total = $user->w_eps_kon + $user->w_roe_kon + $user->w_per_kon;
        //             $w_eps = pow($emiten_kon->prefereni_kriteria['eps_pk'], - ($user['w_eps_kon'] / $w_user_total));
        //             $w_roe = pow($emiten_kon->prefereni_kriteria['roe_pk'], ($user['w_roe_kon'] / $w_user_total));
        //             $w_per = pow($emiten_kon->prefereni_kriteria['per_pk'], ($user['w_per_kon'] / $w_user_total));
        //             $w_total = $w_eps * $w_roe * $w_per;
        //             DB::table('vektor_s')->insert([
        //                 'emiten_id' => $emiten_kon->id,
        //                 'user_id' => $user->id,
        //                 'vektor_s' => $w_total,
        //                 'created_at' => now(),
        //                 'updated_at' => now()
        //             ]);
        //         }
        //         foreach ($emiten_syars as $emiten_syar) {
        //             $w_user_total = $user->w_eps_syar + $user->w_roe_syar + $user->w_der_syar; 
        //             $w_eps = pow($emiten_syar->prefereni_kriteria['eps_pk'], ($user['w_eps_syar'] / $w_user_total));
        //             $w_roe = pow($emiten_syar->prefereni_kriteria['roe_pk'], ($user['w_roe_syar'] / $w_user_total));
        //             $w_der = pow($emiten_syar->prefereni_kriteria['der_pk'], ($user['w_der_syar'] / $w_user_total));
        //             $w_total = $w_eps * $w_roe * $w_der;
        //             DB::table('vektor_s')->insert([
        //                 'emiten_id' => $emiten_syar->id,
        //                 'user_id' => $user->id,
        //                 'vektor_s' => $w_total,
        //                 'created_at' => now(),
        //                 'updated_at' => now()
        //             ]);
        //         }
            // } 
        

  