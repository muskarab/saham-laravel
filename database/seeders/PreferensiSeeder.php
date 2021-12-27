<?php

namespace Database\Seeders;

use App\Models\Emiten;
use App\Models\IndexSaham;
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
        $indexs = IndexSaham::get();
        foreach ($indexs as $index) {
            $min_eps = Emiten::where('index_id', '=', $index->id)->min('eps');
            $min_roe = Emiten::where('index_id', '=', $index->id)->min('roe');
            $min_per = Emiten::where('index_id', '=', $index->id)->min('per');
            $min_der = Emiten::where('index_id', '=', $index->id)->min('der');
            $max_eps = Emiten::where('index_id', '=', $index->id)->max('eps');
            $max_roe = Emiten::where('index_id', '=', $index->id)->max('roe');
            $max_per = Emiten::where('index_id', '=', $index->id)->max('per');
            $max_der = Emiten::where('index_id', '=', $index->id)->max('der');
            $mean_eps = Emiten::where('index_id', '=', $index->id)->avg('eps');
            $mean_roe = Emiten::where('index_id', '=', $index->id)->avg('roe');
            $mean_per = Emiten::where('index_id', '=', $index->id)->avg('per');
            $mean_der = Emiten::where('index_id', '=', $index->id)->avg('der');
            $avg_bawah_eps = ($min_eps + $mean_eps) / 2;
            $avg_bawah_roe = ($min_roe + $mean_roe) / 2;
            $avg_bawah_per = ($min_per + $mean_per) / 2;
            $avg_bawah_der = ($min_der + $mean_der) / 2;
            $avg_atas_eps = ($mean_eps + $max_eps) / 2;
            $avg_atas_roe = ($mean_roe + $max_roe) / 2;
            $avg_atas_per = ($mean_per + $max_per) / 2;
            $avg_atas_der = ($mean_der + $max_der) / 2;
            DB::table('preferensis')->insert([
                'index_id' => $index->id,
                'min_eps' => $min_eps,
                'max_eps' => $max_eps,
                'mean_eps' => $mean_eps,
                'avg_bawah_eps' => $avg_bawah_eps,
                'avg_atas_eps' => $avg_atas_eps,
                'min_roe' => $min_roe,
                'max_roe' => $max_roe,
                'mean_roe' => $mean_roe,
                'avg_bawah_roe' => $avg_bawah_roe,
                'avg_atas_roe' => $avg_atas_roe,
                'min_per' => $min_per,
                'max_per' => $max_per,
                'mean_per' => $mean_per,
                'avg_bawah_per' => $avg_bawah_per,
                'avg_atas_per' => $avg_atas_per,
                'min_der' => $min_der,
                'max_der' => $max_der,
                'mean_der' => $mean_der,
                'avg_bawah_der' => $avg_bawah_der,
                'avg_atas_der' => $avg_atas_der,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
