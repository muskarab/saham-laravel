<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BobotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bobots')->insert([
            'instrument_saham_id' => 1,
            'w_eps' => 0.43,
            'w_roe' => 0.43,
            'w_per' => 0.14,
            'w_der' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('bobots')->insert([
            'instrument_saham_id' => 2,
            'w_eps' => 0.21,
            'w_roe' => 0.29,
            'w_per' => 0,
            'w_der' => 0.50,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
