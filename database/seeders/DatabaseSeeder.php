<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $this->call(RoleSeeder::class);
        $this->call(SemestreSeeder::class);
        $this->call(StatutMatSeeder::class);
        $this->call(MoisSeeder::class);
        $this->call(AnneeSeeder::class);
        $this->call(TypeFormationSeeder::class);
        $this->call(SpecialiteSeeder::class);
       

    }
}
