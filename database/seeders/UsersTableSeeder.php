<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'address' => 'Bangil',
            'date_of_birth' => '2021-11-11',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'instrument_saham_id' => 3,
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'User',
            'address' => 'Malang',
            'date_of_birth' => '2021-11-11',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'instrument_saham_id' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('user12345'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
