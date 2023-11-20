<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonnelAppuiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personnel_appuis')->insert([
            [
                'intitule' => 'Vigile',
            ],

            [
                'intitule' => 'Femme de menage',
            ],
            
            [
                'intitule' => 'Jardinier',
            ],

    

        ]);
    }
}
