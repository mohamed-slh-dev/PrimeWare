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

        DB::table('users')->insert([
            
            'name' => 'Admin',
            'phone'=> "+971 923 0912",
            'email' => 'admin@primeware.ae',
            'password' => Hash::make('123123'),

            'avatar' => 'avatar.png',
            'department_id' => 1,

        ]);

    }
}
