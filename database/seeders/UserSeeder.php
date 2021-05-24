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
<<<<<<< HEAD
            'username' => 'administrator',
=======
>>>>>>> 49e5e24b41baa157729517b1b2e813c96087f2fa
            'password' => Hash::make('adminpass'),
            'role' => 'admin',
            'office_id' => 1,
            'position_id' => 1,
            'photo' => 'user.png',
        ]));

        DB::table('users')->insert(([
            'nip' => 123180001,
            'name' => 'Rahmatul Ramadhani',
<<<<<<< HEAD
            'username' => 'admin.prov',
            'password' => Hash::make('adminpass'),
            'role' => 'provinsi',
=======
            'password' => Hash::make('adminpass'),
            'role' => 'dinas',
>>>>>>> 49e5e24b41baa157729517b1b2e813c96087f2fa
            'office_id' => 1,
            'position_id' => 2,
            'photo' => 'user.png',
        ]));

        DB::table('users')->insert(([
            'nip' => 123180002,
            'name' => 'Ahmad Ridho',
<<<<<<< HEAD
            'username' => 'admin.kota',
            'password' => Hash::make('adminpass'),
            'role' => 'kabupaten/kota',
=======
            'password' => Hash::make('adminpass'),
            'role' => 'Sekolah',
>>>>>>> 49e5e24b41baa157729517b1b2e813c96087f2fa
            'office_id' => 1,
            'position_id' => 2,
            'photo' => 'user.png',
        ]));
    }
}
