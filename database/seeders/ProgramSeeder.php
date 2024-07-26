<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [ 'program_name' => 'BSIT',
            'description' => 'Bachelor of Science in Information Technology', 
            ],
            [ 'program_name' => 'BSED-MT',
             'description' => 'Bachelor of Science in Information Technology', 
            ],
            [ 'program_name' => 'BSED-EN',
             'description' => 'Bachelor of Science in Information Technology', 
            ],
            [ 'program_name' => 'BPA',
             'description' => 'Bachelor of Science in Information Technology', 
            ],
        ];

        DB::table('programs')->insert($programs);
    }
}
