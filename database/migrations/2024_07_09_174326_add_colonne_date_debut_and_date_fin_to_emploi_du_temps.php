<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('emploi_du_temps', function (Blueprint $table) {
            $table->string('heure_debut');
            $table->string('heure_fin');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emploi_du_temps', function (Blueprint $table) {
            //
        });
    }
};