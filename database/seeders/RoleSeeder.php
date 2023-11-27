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
                'categorie_personnel' => 'Simple',
                
            ],

            [
                'intitule' => 'Formateur',
                'categorie_personnel' => 'Simple',
            ],
            
            [
                'intitule' => 'Administrateur',
                'categorie_personnel' => 'Simple',
            ],

            [  
                'intitule' => 'Caissier',
                'categorie_personnel' => 'Personnel Administratif',
              
               
            ],
            [
                'intitule' => 'Comptable',
                'categorie_personnel' => 'Personnel Administratif',
                
            ],
            [
                'intitule' => 'Infirmier',
                'categorie_personnel' => 'Personnel Administratif',
               
            ],

           
            [
                'intitule' => 'Bibliothecaire',
                'categorie_personnel' => 'Personnel Administratif',
                
    
            ],
           
            [
                'intitule' => 'femme de menage',
                'categorie_personnel' => 'Personnel Appui',
               
    
            ],
            [
                'intitule' => 'Jardinier',
                'categorie_personnel' => 'Personnel Appui',
                
    
            ],
            [
                'intitule' => 'Vigile',
                'categorie_personnel' => 'Personnel Appui',
              
    
            ],
           
            [
                'intitule' => 'Tuteur',
                'categorie_personnel' => 'Simple',
            ],

            [
                'intitule' => 'Surveillant',
                'categorie_personnel' => 'Personnel Administratif',
                
    
            ],

            
        ]);
    }
}
