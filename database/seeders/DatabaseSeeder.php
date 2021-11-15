<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\InstrumentSahamSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call([SektorSahamSeeder::class]);
        $this->call([InstrumentSahamSeeder::class]);
        $this->call([IndexSahamSeeder::class]);
        $this->call([SektorSeeder::class]);
        $this->call([EmitenSeeder::class]);
        $this->call([BobotSeeder::class]);
        $this->call([PreferensiSeeder::class]);
    }
}
