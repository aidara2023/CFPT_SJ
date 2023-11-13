<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnneeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('annee_academiques')->insert([
            [
                'intitule' => '2023 - 2024',
            ],
            [
                'intitule' => '2024 - 2025',
            ],
            [
                'intitule' => '2025 - 2026',
            ],
            [
                'intitule' => '2026 - 2027',
            ],
        ]);
    }
}
