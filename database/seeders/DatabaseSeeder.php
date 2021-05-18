<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TownSeeder::class,
            OfficeSeeder::class,
            PositionSeeder::class,
            UserSeeder::class,
            IPK1Seeder::class,
        ]);
    }
}
