<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SektorSahamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sektor_sahams')->insert([
            'name' => 'Barang Baku',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektor_sahams')->insert([
            'name' => 'Non-Primer',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektor_sahams')->insert([
            'name' => 'Non-Primer',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektor_sahams')->insert([
            'name' => 'Energi',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektor_sahams')->insert([
            'name' => 'Keuangan',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektor_sahams')->insert([
            'name' => 'Kesehatan ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektor_sahams')->insert([
            'name' => 'Perindustrian',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektor_sahams')->insert([
            'name' => 'Infrastruktur',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektor_sahams')->insert([
            'name' => 'Properti',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektor_sahams')->insert([
            'name' => 'Teknologi',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektor_sahams')->insert([
            'name' => 'Transportasi',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
