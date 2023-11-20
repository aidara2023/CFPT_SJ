<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonnelAdministratifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personnel_administratifs')->insert([
            [
                'intitule' => 'Caissier',
            ],

            [
                'intitule' => 'Comptable',
            ],
            
            [
                'intitule' => 'Infirmier',
            ],

            [
                'intitule' => 'Surveillant',
            ],
           
            [
                'intitule' => 'Bibliothecaire',
            ],

           
            
            
        ]);
    }
}
