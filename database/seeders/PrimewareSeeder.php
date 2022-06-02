<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PrimewareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('primeware')->insert([
            
            'name' => 'Primeware',
            'phone'=> "+971 23 633 3227",
            'email' => 'info@primeware.ae',

        ]);
    }
}
