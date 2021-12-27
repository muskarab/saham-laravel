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
            'tahun' => '2018',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('index_sahams')->insert([
            'name' => 'JII',
            'instrument_saham_id' => 2,
            'tahun' => '2018',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('index_sahams')->insert([
            'name' => 'QWER',
            'instrument_saham_id' => 1,
            'tahun' => '2019',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('index_sahams')->insert([
            'name' => 'ASDF',
            'instrument_saham_id' => 2,
            'tahun' => '2019',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
