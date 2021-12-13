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
            'w_eps_kon' => 6,
            'w_roe_kon' => 6,
            'w_per_kon' => 2,
            'w_der_kon' => 0,
            'w_eps_syar' => 3,
            'w_roe_syar' => 4,
            'w_per_syar' => 0,
            'w_der_syar' => 7,
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
            'instrument_saham_id' => 1,
            'w_eps_kon' => 1,
            'w_roe_kon' => 2,
            'w_per_kon' => 3,
            'w_der_kon' => 0,
            'w_eps_syar' => 0,
            'w_roe_syar' => 0,
            'w_per_syar' => 0,
            'w_der_syar' => 0,
            'email_verified_at' => now(),
            'password' => Hash::make('user12345'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'User2',
            'address' => 'Malang',
            'date_of_birth' => '2021-11-11',
            'email' => 'user2@gmail.com',
            'role' => 'user',
            'instrument_saham_id' => 2,
            'w_eps_kon' => 0,
            'w_roe_kon' => 0,
            'w_per_kon' => 0,
            'w_der_kon' => 0,
            'w_eps_syar' => 1,
            'w_roe_syar' => 2,
            'w_per_syar' => 0,
            'w_der_syar' => 3,
            'email_verified_at' => now(),
            'password' => Hash::make('user12345'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'User3',
            'address' => 'Malang',
            'date_of_birth' => '2021-11-11',
            'email' => 'user3@gmail.com',
            'role' => 'user',
            'instrument_saham_id' => 1,
            'w_eps_kon' => 6,
            'w_roe_kon' => 6,
            'w_per_kon' => 2,
            'w_der_kon' => 0,
            'w_eps_syar' => 0,
            'w_roe_syar' => 0,
            'w_per_syar' => 0,
            'w_der_syar' => 0,
            'email_verified_at' => now(),
            'password' => Hash::make('user12345'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'User4',
            'address' => 'Malang',
            'date_of_birth' => '2021-11-11',
            'email' => 'user4@gmail.com',
            'role' => 'user',
            'instrument_saham_id' => 2,
            'w_eps_kon' => 0,
            'w_roe_kon' => 0,
            'w_per_kon' => 0,
            'w_der_kon' => 0,
            'w_eps_syar' => 3,
            'w_roe_syar' => 4,
            'w_per_syar' => 0,
            'w_der_syar' => 7,
            'email_verified_at' => now(),
            'password' => Hash::make('user12345'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
