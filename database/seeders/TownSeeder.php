<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('towns')->insert([
            'town_name' => 'Agam',
            'town_slug' => 'Kabupaten',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Dharmasraya',
            'town_slug' => 'Kabupaten',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Kepulauan Mentawai',
            'town_slug' => 'Kabupaten',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Lima Puluh Kota',
            'town_slug' => 'Kabupaten',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Padang Pariaman',
            'town_slug' => 'Kabupaten',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Pasaman',
            'town_slug' => 'Kabupaten',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Pasaman Barat',
            'town_slug' => 'Kabupaten',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Pesisir Selatan',
            'town_slug' => 'Kabupaten',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Sijunjung',
            'town_slug' => 'Kabupaten',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Solok',
            'town_slug' => 'Kabupaten',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Solok Selatan',
            'town_slug' => 'Kabupaten',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Tanah Datar',
            'town_slug' => 'Kabupaten',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Bukittinggi',
            'town_slug' => 'Kota',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Padang',
            'town_slug' => 'Kota',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Padangpanjang',
            'town_slug' => 'Kota',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Pariaman',
            'town_slug' => 'Kota',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Payakumbuh',
            'town_slug' => 'Kota',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Sawahlunto',
            'town_slug' => 'Kota',
        ]);
        DB::table('towns')->insert([
            'town_name' => 'Solok',
            'town_slug' => 'Kota',
        ]);
    }
}
