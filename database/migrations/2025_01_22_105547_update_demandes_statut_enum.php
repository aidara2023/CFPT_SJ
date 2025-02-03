<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDemandesStatutEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {
            // Supprimer l'ancienne contrainte enum
            $table->dropColumn('statut');
        });

        Schema::table('demandes', function (Blueprint $table) {
            // Créer une nouvelle colonne avec les valeurs mises à jour
            $table->enum('statut', ['en_attente', 'en_cours', 'reçu', 'rejete', 'validé', 'traitée'])
                  ->default('en_attente')
                  ->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->dropColumn('statut');
        });

        Schema::table('demandes', function (Blueprint $table) {
            $table->enum('statut', ['en_attente', 'en_cours', 'reçu', 'rejete', 'validé'])
                  ->default('en_attente')
                  ->after('id');
        });
    }
}
