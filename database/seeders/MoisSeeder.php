<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mois')->insert([
           
            [
                'intitule' => 'Octobre',
            ],
            [
                'intitule' => 'Novembre',
            ],
            [
                'intitule' => 'Décembre',
            ],
            [
                'intitule' => 'Janvier',
            ],
            [
                'intitule' => 'Fevrier',
            ],
            [
                'intitule' => 'Mars',
            ],
            [
                'intitule' => 'Avril',
            ],
            [
                'intitule' => 'Mai',
            ],
            [
                'intitule' => 'Juin',
            ],
            [
                'intitule' => 'Juillet',
            ],
            [
                'intitule' => 'Août',
            ],
            [
                'intitule' => 'Septembre',
            ],
        ]);
    }
}
