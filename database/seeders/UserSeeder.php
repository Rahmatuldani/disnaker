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
            'password' => Hash::make('adminpass'),
            'role' => 'admin',
            'office_id' => 1,
            'position_id' => 1,
            'photo' => 'user.png',
        ]));

        DB::table('users')->insert(([
            'nip' => 123180027,
            'name' => 'Rahmatul Ramadhani',
            'password' => Hash::make('adminpass'),
            'role' => 'user',
            'office_id' => 1,
            'position_id' => 2,
            'photo' => 'user.png',
        ]));
    }
}
