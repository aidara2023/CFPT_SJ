<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('semestres')->insert([
            [
                'intitule' => 'Semestre 1',
            ],
            [
                'intitule' => 'Semestre 2',
            ],
        ]);
    }
}
