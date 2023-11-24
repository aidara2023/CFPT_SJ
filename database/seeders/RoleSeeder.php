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

            [  'id_personnel_appui' => 1,
                'intitule' => 'Personnel Appui',
              
               
            ],
            [
                'intitule' => 'Personnel Appui',
                'id_personnel_appui' => 2
            ],
            [
                'intitule' => 'Personnel Appui',
                'id_personnel_appui' => 3
            ],

           
            [
                'intitule' => 'Personnel Administratif',
                'id_personnel_administratif' => 1
    
            ],
            [
                'intitule' => 'Personnel Administratif',
                'id_personnel_administratif' => 2
    
            ],
            [
                'intitule' => 'Personnel Administratif',
                'id_personnel_administratif' => 3
    
            ],
            [
                'intitule' => 'Personnel Administratif',
                'id_personnel_administratif' => 4
    
            ],
            [
                'intitule' => 'Personnel Administratif',
                'id_personnel_administratif' => 5
    
            ],
            


            [
                'intitule' => 'Tuteur',
            ],
           
            
            
        ]);
    }
}
