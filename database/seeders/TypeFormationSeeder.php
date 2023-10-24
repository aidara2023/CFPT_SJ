<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeFormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_formations')->insert([
            [
                'intitule' => 'BTI Jour',
            ],
            [
                'intitule' => 'BTI Soir',
            ],
            [
                'intitule' => 'BTS Jour',
            ],
            [
                'intitule' => 'BTS Soir',
            ],
         
        ]);
    }
}
