<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            $table->dropColumn('secteur_activite'); // Supprime la colonne secteur_activite
        });
    }
    
    public function down()
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            $table->string('secteur_activite', 100)->nullable(); // Ajoute à nouveau la colonne secteur_activite si besoin
        });
    }
};
