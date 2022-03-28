<?php

namespace Database\Seeders;

use App\Models\Emiten;
use App\Models\User;
use App\Models\Preferensi;
use App\Models\IndexSaham;
use App\Models\VektorX;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VektorYSeeder extends Seeder
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
        $emitens_kon = Emiten::where('id','<', 46)->get(); 
        $emitens_syar = Emiten::where('id','>', 45)->get(); 
        $preferensis_kon = Preferensi::where('index_id','1')->first();
        $preferensis_syar = Preferensi::where('index_id','2')->first();

        if (! function_exists('divnum')) {

            function divnum($numerator, $denominator)
            {
                return $denominator == 0 ? 0 : ($numerator / $denominator);
            }

        }

        foreach ($users as $user) {
            // // $jumlah_user = $user->mysql_num_rows(user);
  
            // if ($user<$user->num_rows) {
            //     // code...
            
                $w_user_total_kon = $user->w_eps_kon + $user->w_roe_kon + $user->w_per_kon;
                $w_des_eps_kon = ($user->w_eps_kon / $w_user_total_kon);
                $w_des_roe_kon = ($user->w_roe_kon / $w_user_total_kon);
                $w_des_per_kon = ($user->w_per_kon / $w_user_total_kon);
                $w_des_der_kon = ($user->w_der_kon / $w_user_total_kon);

                $w_user_total_syar = $user->w_eps_syar + $user->w_roe_syar + $user->w_der_syar;
                $w_des_eps_syar = ($user->w_eps_syar / $w_user_total_syar);
                $w_des_roe_syar = ($user->w_roe_syar / $w_user_total_syar);
                $w_des_per_syar = ($user->w_per_syar / $w_user_total_syar);
                $w_des_der_syar = ($user->w_der_syar / $w_user_total_syar);

                $sim_atas_eps = ($preferensis_kon['max_eps'] - $preferensis_kon['min_eps']);
                $sim_bawah_eps = ($preferensis_kon['max_eps'] - $preferensis_kon['min_eps']);
                $sim_3_eps = ($sim_atas_eps / $sim_bawah_eps) * 1000;
                $pembanding_eps_kon = $sim_3_eps * $w_des_eps_kon;

                $sim_atas_roe = ($preferensis_kon['max_roe'] - $preferensis_kon['min_roe']);
                $sim_bawah_roe = ($preferensis_kon['max_roe'] - $preferensis_kon['min_roe']);
                $sim_3_roe = ($sim_atas_roe / $sim_bawah_roe) * 1000;
                $pembanding_roe_kon = $sim_3_roe * $w_des_roe_kon;

                $sim_atas_per = ($preferensis_kon['max_per'] - $preferensis_kon['min_per']);
                $sim_bawah_per = ($preferensis_kon['max_per'] - $preferensis_kon['min_per']);
                $sim_3_per = ($sim_atas_per / $sim_bawah_per) * 1000;
                $pembanding_per_kon = $sim_3_per * $w_des_per_kon;

                $sim_atas_der = ($preferensis_kon['max_der'] - $preferensis_kon['min_der']);
                $sim_bawah_der = ($preferensis_kon['max_der'] - $preferensis_kon['min_der']);
                $sim_3_der = ($sim_atas_der / $sim_bawah_der) * 1000;
                $pembanding_der_kon = $sim_3_der * $w_des_der_kon;

            $vektors_x_kon = VektorX::join('emitens', 'vektor_x.emiten_id', '=', 'emitens.id')->where('vektor_x.user_id', $user->id)->where('emitens.index_id', 1)->get();
            
            foreach ($vektors_x_kon as $vektor_x_kon) {
                //Pembanding KONVENSIONAL            
                $vektor_y_eps = -($vektor_x_kon['sim_eps_kon'])* -($pembanding_eps_kon);
                $vektor_y_roe = ($vektor_x_kon['sim_roe_kon'])* ($pembanding_roe_kon);
                $vektor_y_per = ($vektor_x_kon['sim_per_kon'])* ($pembanding_per_kon);
                $akar_1 = sqrt((pow((-$vektor_x_kon['sim_eps_kon']),2))+(pow(($vektor_x_kon['sim_roe_kon']),2))+(pow(($vektor_x_kon['sim_per_kon']),2)));
                $akar_2 = sqrt((pow((-$pembanding_eps_kon),2))+(pow($pembanding_roe_kon,2))+(pow($pembanding_per_kon,2)));
                $rumus_atas = $vektor_y_eps + $vektor_y_roe + $vektor_y_per;
                $rumus_bawah = $akar_1 * $akar_2;
                $vektor_y_kon = divnum($rumus_atas , $rumus_bawah);

                DB::table('vektor_y')->insert([
                'user_id' => $vektor_x_kon->user_id,
                'emiten_id' => $vektor_x_kon->emiten_id,
                'vektor_y' => $vektor_y_kon,
                'created_at' => now(),
                'updated_at' => now()
                ]);
            }
                //Pembanding SYARIAH
                $sim_atas_eps = ($preferensis_syar['max_eps'] - $preferensis_syar['min_eps']);
                $sim_bawah_eps = ($preferensis_syar['max_eps'] - $preferensis_syar['min_eps']);
                $sim_3_eps = ($sim_atas_eps / $sim_bawah_eps) * 1000;
                $pembanding_eps_syar = $sim_3_eps * $w_des_eps_syar;

                $sim_atas_roe = ($preferensis_syar['max_roe'] - $preferensis_syar['min_roe']);
                $sim_bawah_roe = ($preferensis_syar['max_roe'] - $preferensis_syar['min_roe']);
                $sim_3_roe = ($sim_atas_roe / $sim_bawah_roe) * 1000;
                $pembanding_roe_syar = $sim_3_roe * $w_des_roe_syar;

                $sim_atas_per = ($preferensis_syar['max_per'] - $preferensis_syar['min_per']);
                $sim_bawah_per = ($preferensis_syar['max_per'] - $preferensis_syar['min_per']);
                $sim_3_per = ($sim_atas_per / $sim_bawah_per) * 1000;
                $pembanding_per_syar = $sim_3_per * $w_des_per_syar;

                $sim_atas_der = ($preferensis_syar['max_der'] - $preferensis_syar['min_der']);
                $sim_bawah_der = ($preferensis_syar['max_der'] - $preferensis_syar['min_der']);
                $sim_3_der = ($sim_atas_der / $sim_bawah_der) * 1000;
                $pembanding_der_syar = $sim_3_der * $w_des_der_syar;

            $vektors_x_syar = VektorX::join('emitens', 'vektor_x.emiten_id', '=', 'emitens.id')->where('vektor_x.user_id', $user->id)->where('emitens.index_id', 2)->get();

            foreach ($vektors_x_syar as $vektor_x_syar){

                $vektor_y_eps = ($vektor_x_syar['sim_eps_syar'])* ($pembanding_eps_syar);
                $vektor_y_roe = ($vektor_x_syar['sim_roe_syar'])* ($pembanding_roe_syar);
                $vektor_y_der = ($vektor_x_syar['sim_der_syar'])* ($pembanding_der_syar);
                $akar_1 = sqrt((pow(($vektor_x_syar['sim_eps_syar']),2))+(pow(($vektor_x_syar['sim_roe_syar']),2))+(pow(($vektor_x_syar['sim_der_syar']),2)));
                $akar_2 = sqrt((pow(($pembanding_eps_syar),2))+(pow($pembanding_roe_syar,2))+(pow($pembanding_der_syar,2)));
                $rumus_atas = $vektor_y_eps + $vektor_y_roe + $vektor_y_der;
                $rumus_bawah = $akar_1 * $akar_2;
                $vektor_y_syar = divnum($rumus_atas , $rumus_bawah);

                DB::table('vektor_y')->insert([
                    'user_id' => $vektor_x_syar->user_id,
                    'emiten_id' => $vektor_x_syar->emiten_id,
                    'vektor_y' => $vektor_y_syar,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}