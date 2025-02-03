<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCommandesStatutEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commandes', function (Blueprint $table) {
            // Supprimer l'ancienne contrainte enum
            $table->dropColumn('statut');
        });

        Schema::table('commandes', function (Blueprint $table) {
            // Créer une nouvelle colonne avec les valeurs mises à jour
            $table->enum('statut', ['envoyé', 'en_attente', 'livré', 'non_livré'])->after('date_commande');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropColumn('statut');
        });

        Schema::table('commandes', function (Blueprint $table) {
            $table->enum('statut', ['envoyé', 'livré', 'non livré'])->after('date_commande');
        });
    }
}
