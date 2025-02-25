<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIdMaterielIdConsommableAndQuantiteFromDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {
            // Supprimer les contraintes de clé étrangère
            $table->dropForeign(['id_materiel']);
            $table->dropForeign(['id_consommable']);

            // Supprimer les colonnes
            $table->dropColumn(['id_materiel', 'id_consommable', 'quantite']);
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
            // Réajout des colonnes
            $table->unsignedBigInteger('id_materiel')->nullable();
            $table->unsignedBigInteger('id_consommable')->nullable();
            $table->integer('quantite')->nullable();

            // Réajout des contraintes de clé étrangère
            $table->foreign('id_materiel')->references('id')->on('materiels')->onDelete('cascade');
            $table->foreign('id_consommable')->references('id')->on('consommables')->onDelete('cascade');
        });
    }
}
