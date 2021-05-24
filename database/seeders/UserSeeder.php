<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(([
            'nip' => 123180000,
            'name' => 'Administrator',
            'username' => 'administrator',
            'password' => Hash::make('adminpass'),
            'role' => 'admin',
            'office_id' => 1,
            'photo' => 'user.png',
        ]));

        DB::table('users')->insert(([
            'nip' => 123180001,
            'name' => 'Rahmatul Ramadhani',
            'username' => 'admin.prov',
            'password' => Hash::make('adminpass'),
            'role' => 'provinsi',
            'office_id' => 1,
            'photo' => 'user.png',
        ]));

        DB::table('users')->insert(([
            'nip' => 123180002,
            'name' => 'Ahmad Ridho',
            'username' => 'admin.kota',
            'password' => Hash::make('adminpass'),
            'role' => 'kabupaten/kota',
            'office_id' => 1,
            'photo' => 'user.png',
        ]));
    }
}
