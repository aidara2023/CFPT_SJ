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
        Schema::table('livres', function (Blueprint $table) {
            //
           $table->dropColumn('genre');
            $table->dropColumn('annee_publication');
            $table->dropColumn('exemplaire_disponibles');

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('livres', function (Blueprint $table) {
            $table->string('genre');
            $table->date('annee_publication')->nullable();
            $table->integer('exemplaire_disponibles');
        });
    }
};
