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
            $table->unsignedBigInteger('secteur_activite_id')->nullable(); // Ajoute la colonne secteur_activite_id
    
            // Ajoute la clé étrangère
            $table->foreign('secteur_activite_id')->references('id')->on('secteur_activites')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            // Supprime la clé étrangère
            $table->dropForeign(['secteur_activite_id']);
            
            // Supprime la colonne secteur_activite_id
            $table->dropColumn('secteur_activite_id');
        });
    }
};
