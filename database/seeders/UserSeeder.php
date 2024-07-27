<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'AROtrack',
            'email' => 'arotrack@2024',
            'password' => bcrypt('User123'),
            'type' => 'Admission',
        ]);
        // DB::table('users')->insert([
        //     'name' => 'Registrar',
        //     'email' => 'registrar@2024',
        //     'password' => bcrypt('User123'),
        //     'type' => 'Registrar',
        // ]);
    }
}
