<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offices')->insert([
            'office_name' => 'Disnakertrans Agam',
            'office_address' => 'Jl. Agam',
            'office_phone' => '08123456789',
            'town_id' => 1,
        ]);
    }
}
