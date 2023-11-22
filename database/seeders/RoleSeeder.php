<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'intitule' => 'Eleve',
            ],

            [
                'intitule' => 'Formateur',
            ],
            
            [
                'intitule' => 'Administrateur',
            ],

            [
                'intitule' => 'Personnel Appui',
            ],
           
            [
                'intitule' => 'Personnel Administratif',
            ],

            [
                'intitule' => 'Tuteur',
            ],
           
            
            
        ]);
    }
}
