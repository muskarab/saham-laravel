<?php

namespace Database\Seeders;

use App\Models\Emiten;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreferensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $min_eps_kon = Emiten::where('index_id', '=', 1)->min('eps');
        $min_roe_kon = Emiten::where('index_id', '=', 1)->min('roe');
        $min_per_kon = Emiten::where('index_id', '=', 1)->min('per');
        $min_der_kon = Emiten::where('index_id', '=', 1)->min('der');
        $max_eps_kon = Emiten::where('index_id', '=', 1)->max('eps');
        $max_roe_kon = Emiten::where('index_id', '=', 1)->max('roe');
        $max_per_kon = Emiten::where('index_id', '=', 1)->max('per');
        $max_der_kon = Emiten::where('index_id', '=', 1)->max('der');
        $mean_eps_kon = Emiten::where('index_id', '=', 1)->avg('eps');
        $mean_roe_kon = Emiten::where('index_id', '=', 1)->avg('roe');
        $mean_per_kon = Emiten::where('index_id', '=', 1)->avg('per');
        $mean_der_kon = Emiten::where('index_id', '=', 1)->avg('der');
        $avg_bawah_eps_kon = ($min_eps_kon + $mean_eps_kon) / 2;
        $avg_bawah_roe_kon = ($min_roe_kon + $mean_roe_kon) / 2;
        $avg_bawah_per_kon = ($min_per_kon + $mean_per_kon) / 2;
        $avg_bawah_der_kon = ($min_der_kon + $mean_der_kon) / 2;
        $avg_atas_eps_kon = ($mean_eps_kon + $max_eps_kon) / 2;
        $avg_atas_roe_kon = ($mean_roe_kon + $max_roe_kon) / 2;
        $avg_atas_per_kon = ($mean_per_kon + $max_per_kon) / 2;
        $avg_atas_der_kon = ($mean_der_kon + $max_der_kon) / 2;
        $min_eps_sya = Emiten::where('index_id', '=', 2)->min('eps');
        $min_roe_sya = Emiten::where('index_id', '=', 2)->min('roe');
        $min_per_sya = Emiten::where('index_id', '=', 2)->min('per');
        $min_der_sya = Emiten::where('index_id', '=', 2)->min('der');
        $max_eps_sya = Emiten::where('index_id', '=', 2)->max('eps');
        $max_roe_sya = Emiten::where('index_id', '=', 2)->max('roe');
        $max_per_sya = Emiten::where('index_id', '=', 2)->max('per');
        $max_der_sya = Emiten::where('index_id', '=', 2)->max('der');
        $mean_eps_sya = Emiten::where('index_id', '=', 2)->avg('eps');
        $mean_roe_sya = Emiten::where('index_id', '=', 2)->avg('roe');
        $mean_per_sya = Emiten::where('index_id', '=', 2)->avg('per');
        $mean_der_sya = Emiten::where('index_id', '=', 2)->avg('der');
        $avg_bawah_eps_sya = ($min_eps_sya + $mean_eps_sya) / 2;
        $avg_bawah_roe_sya = ($min_roe_sya + $mean_roe_sya) / 2;
        $avg_bawah_per_sya = ($min_per_sya + $mean_per_sya) / 2;
        $avg_bawah_der_sya = ($min_der_sya + $mean_der_sya) / 2;
        $avg_atas_eps_sya = ($mean_eps_sya + $max_eps_sya) / 2;
        $avg_atas_roe_sya = ($mean_roe_sya + $max_roe_sya) / 2;
        $avg_atas_per_sya = ($mean_per_sya + $max_per_sya) / 2;
        $avg_atas_der_sya = ($mean_der_sya + $max_der_sya) / 2;

        DB::table('preferensis')->insert([
            'index_id' => 1,
            'min_eps' => $min_eps_kon,
            'max_eps' => $max_eps_kon,
            'mean_eps' => $mean_eps_kon,
            'avg_bawah_eps' => $avg_bawah_eps_kon,
            'avg_atas_eps' => $avg_atas_eps_kon,
            'min_roe' => $min_roe_kon,
            'max_roe' => $max_roe_kon,
            'mean_roe' => $mean_roe_kon,
            'avg_bawah_roe' => $avg_bawah_roe_kon,
            'avg_atas_roe' => $avg_atas_roe_kon,
            'min_per' => $min_per_kon,
            'max_per' => $max_per_kon,
            'mean_per' => $mean_per_kon,
            'avg_bawah_per' => $avg_bawah_per_kon,
            'avg_atas_per' => $avg_atas_per_kon,
            'min_der' => $min_der_kon,
            'max_der' => $max_der_kon,
            'mean_der' => $mean_der_kon,
            'avg_bawah_der' => $avg_bawah_der_kon,
            'avg_atas_der' => $avg_atas_der_kon,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('preferensis')->insert([
            'index_id' => 2,
            'min_eps' => $min_eps_sya,
            'max_eps' => $max_eps_sya,
            'mean_eps' => $mean_eps_sya,
            'avg_bawah_eps' => $avg_bawah_eps_sya,
            'avg_atas_eps' => $avg_atas_eps_sya,
            'min_roe' => $min_roe_sya,
            'max_roe' => $max_roe_sya,
            'mean_roe' => $mean_roe_sya,
            'avg_bawah_roe' => $avg_bawah_roe_sya,
            'avg_atas_roe' => $avg_atas_roe_sya,
            'min_per' => $min_per_sya,
            'max_per' => $max_per_sya,
            'mean_per' => $mean_per_sya,
            'avg_bawah_per' => $avg_bawah_per_sya,
            'avg_atas_per' => $avg_atas_per_sya,
            'min_der' => $min_der_sya,
            'max_der' => $max_der_sya,
            'mean_der' => $mean_der_sya,
            'avg_bawah_der' => $avg_bawah_der_sya,
            'avg_atas_der' => $avg_atas_der_sya,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
