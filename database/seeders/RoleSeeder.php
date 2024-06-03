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
                'categorie_personnel' => 'Personnel Administratif',
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
                'intitule' => 'Femme de menage',
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
            [
                'intitule' => 'Directeur',
                'categorie_personnel' => 'Personnel Administratif',

            ],
            [
                'intitule' => 'Reprographe',
                'categorie_personnel' => 'Personnel Administratif',

            ],
            [
                'intitule' => 'Assistante SAF',
                'categorie_personnel' => 'Personnel Administratif',

            ],
            [
                'intitule' => 'Gestionnaire de stock',
                'categorie_personnel' => 'Personnel Administratif',

            ],
            [
                'intitule' => 'Logisticien',
                'categorie_personnel' => 'Personnel Appui',

            ],
            [
                'intitule' => 'Chauffeur',
                'categorie_personnel' => 'Personnel Appui',

            ],
            [
                'intitule' => 'Jardinier',
                'categorie_personnel' => 'Personnel Appui',

            ],
            [
                'intitule' => 'Technicien',
                'categorie_personnel' => 'Personnel Administratif',

            ],
            [
                'intitule' => 'Technicienne de surface',
                'categorie_personnel' => 'Personnel Appui',

            ],
            [
                'intitule' => 'Assistante AC',
                'categorie_personnel' => 'Personnel Administratif',

            ],
            [
                'intitule' => 'Assistante DG',
                'categorie_personnel' => 'Personnel Administratif',

            ],
            [
                'intitule' => 'Chef Service',
                'categorie_personnel' => 'Personnel Administratif',

            ],
            [
                'intitule' => 'Chef Agence Comptable',
                'categorie_personnel' => 'Personnel Administratif',

            ],
            [
                'intitule' => 'Recouvrement',
                'categorie_personnel' => 'Personnel Administratif',

            ],
            /* 1
Eleve

2
Formateur

3
Administrateur

4
Caissier

5
Comptable

6
Infirmier

7
Bibliothecaire

8
femme de menage

9
Jardinier

10
Vigile

11
Tuteur

12
Surveillant

13
Directeur

14
Reprographe

15
Assistante SAF

16
Gestionnaire de stock

17
Logisticien

18
Chauffeur

19
Jardinier

20
Technicien

21
Technicienne de surface

22
Assistante AC

23
Assistante DG

24
Chef Service

25
Chef Agence Comptable */


        ]);
    }
}
