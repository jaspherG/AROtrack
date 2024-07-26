<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [ 'service_name' => 'admission',
            'document_ids' => json_encode([1,2,3,4,5,6,7,8,9]), 
            ],
            [ 'service_name' => 'returnee',
            'document_ids' => json_encode([10,11,12,13,14,15]), 
            ],
            [ 'service_name' => 'transferee',
            'document_ids' => json_encode([16,17,18,19]), 
            ],
            [ 'service_name' => 'cross-enroll',
            'document_ids' => json_encode([20,21,22,23]), 
            ],
        ];

        DB::table('services')->insert($services);
    }
}
