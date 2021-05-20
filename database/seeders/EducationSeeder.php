<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educations')->insert([
            'education_id' => '1101',
            'education_name' => 'TIDAK TAMAT SD',
            'created_at' => date("Y-m-d h:s:i"),
            'updated_at' => date("Y-m-d h:s:i"),
        ]);
        DB::table('educations')->insert([
            'education_id' => '1102',
            'education_name' => 'SD',
            'created_at' => date("Y-m-d h:s:i"),
            'updated_at' => date("Y-m-d h:s:i"),
        ]);DB::table('educations')->insert([
            'education_id' => '1103',
            'education_name' => 'SETINGKAT SD',
            'created_at' => date("Y-m-d h:s:i"),
            'updated_at' => date("Y-m-d h:s:i"),
        ]);DB::table('educations')->insert([
            'education_id' => '2001',
            'education_name' => 'SLTP UMUM',
            'created_at' => date("Y-m-d h:s:i"),
            'updated_at' => date("Y-m-d h:s:i"),
        ]);DB::table('educations')->insert([
            'education_id' => '2101',
            'education_name' => 'SEKOLAH MENENGAH PERTAMA',
            'created_at' => date("Y-m-d h:s:i"),
            'updated_at' => date("Y-m-d h:s:i"),
        ]);
    }
}
