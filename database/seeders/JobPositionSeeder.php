<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_positions')->insert([
            'job_position_id' => '1110',
            'job_position_name' => 'ANGGOTA BADAN LEGISLATIF',
            'created_at' => date("Y-m-d h:s:i"),
            'updated_at' => date("Y-m-d h:s:i"),
        ]);
        DB::table('job_positions')->insert([
            'job_position_id' => '1120',
            'job_position_name' => 'PEJABAT TINGGI PEMERINTAH',
            'created_at' => date("Y-m-d h:s:i"),
            'updated_at' => date("Y-m-d h:s:i"),
        ]);DB::table('job_positions')->insert([
            'job_position_id' => '1130',
            'job_position_name' => 'KEPALA DESA DAN LURAH',
            'created_at' => date("Y-m-d h:s:i"),
            'updated_at' => date("Y-m-d h:s:i"),
        ]);DB::table('job_positions')->insert([
            'job_position_id' => '1141',
            'job_position_name' => 'PEMIMPIN ORGANISASI PARTAI POLITIK',
            'created_at' => date("Y-m-d h:s:i"),
            'updated_at' => date("Y-m-d h:s:i"),
        ]);DB::table('job_positions')->insert([
            'job_position_id' => '1237',
            'job_position_name' => 'MANAJER PENELITIAN DAN PEMASARAN',
            'created_at' => date("Y-m-d h:s:i"),
            'updated_at' => date("Y-m-d h:s:i"),
        ]);
    }
}
