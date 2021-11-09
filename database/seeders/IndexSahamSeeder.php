<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndexSahamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('index_sahams')->insert([
            'name' => 'LQ45',
            'instrument_saham_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('index_sahams')->insert([
            'name' => 'JII',
            'instrument_saham_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
