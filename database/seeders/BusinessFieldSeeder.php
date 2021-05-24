<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_fields')->insert([
            'business_field_id' => '0011',
            'business_field_name' => 'PERTANIAN TANAMAN SEMUSIM',
            'created_at' => date("Y-m-d h:s:i"),
            'updated_at' => date("Y-m-d h:s:i"),
        ]);
        DB::table('business_fields')->insert([
            'business_field_id' => '0012',
            'business_field_name' => 'PERTANIAN TANAMAN TAHUNAN',
            'created_at' => date("Y-m-d h:s:i"),
            'updated_at' => date("Y-m-d h:s:i"),
        ]);
        DB::table('business_fields')->insert([
            'business_field_id' => '0013',
            'business_field_name' => 'PERTANIAN TANAMAN HIAS',
            'created_at' => date("Y-m-d h:s:i"),
            'updated_at' => date("Y-m-d h:s:i"),
        ]);
        DB::table('business_fields')->insert([
            'business_field_id' => '0014',
            'business_field_name' => 'PETERNAKAN',
            'created_at' => date("Y-m-d h:s:i"),
            'updated_at' => date("Y-m-d h:s:i"),
        ]);
        DB::table('business_fields')->insert([
            'business_field_id' => '0016',
            'business_field_name' => 'JASA PENUNJANG PERTANIAN DAN PASCA PANEN',
            'created_at' => date("Y-m-d h:s:i"),
            'updated_at' => date("Y-m-d h:s:i"),
        ]);
    }
}
