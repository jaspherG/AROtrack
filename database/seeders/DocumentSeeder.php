<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            ['document_name' => 'Grade 10 Report Card'],
            ['document_name' => 'Grade 11 Report Card'],
            ['document_name' => 'Grade 12 Report Card'],
            ['document_name' => 'Good Moral'],
            ['document_name' => 'X-ray & Medical Certificate'],
            ['document_name' => 'Original PSA Birth Certificate'],
            ['document_name' => 'Form 137-A Copy for PUP Bansud'],
            ['document_name' => 'SARF'],
            ['document_name' => 'Affidavit of Non-Enrollment'],
            ['document_name' => 'Informative Grades'],
            ['document_name' => 'Medical Certificate'],
            ['document_name' => 'Re-Admission Form'],
            ['document_name' => 'Letter of Intent'],
            ['document_name' => 'Admission Certificate'],
            ['document_name' => 'Evaluation'],
            ['document_name' => 'TOR'],
            ['document_name' => 'Honorable Dismissal'],
            ['document_name' => 'Waiver for Transferee'],
            ['document_name' => 'X-ray Medical Certificate'],
        ];

        DB::table('documents')->insert($documents);
    }
}
