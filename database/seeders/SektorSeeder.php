<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SektorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sektors')->insert([
            'name' => 'Barang Baku',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektors')->insert([
            'name' => 'Non-Primer',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektors')->insert([
            'name' => 'Primer',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektors')->insert([
            'name' => 'Energi',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektors')->insert([
            'name' => 'Keuangan',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektors')->insert([
            'name' => 'Kesehatan ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektors')->insert([
            'name' => 'Perindustrian ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektors')->insert([
            'name' => 'Infrastruktur ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektors')->insert([
            'name' => 'Properti ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektors')->insert([
            'name' => 'Teknologi ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sektors')->insert([
            'name' => 'Transportasi ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
