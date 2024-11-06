<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdDemandeToMaterielsTable extends Migration
{
    public function up()
    {
        Schema::table('materiels', function (Blueprint $table) {
            // Ajouter la colonne id_demande
            $table->unsignedBigInteger('id_demande')->nullable(); // Remplacez 'some_column' par la colonne appropriée

            // Ajouter la contrainte de clé étrangère
            $table->foreign('id_demande')->references('id')->on('demandes')->onDelete('cascade'); // Assurez-vous que 'demandes' est le nom de la table référencée
        });
    }

    public function down()
    {
        Schema::table('materiels', function (Blueprint $table) {
            // Supprimer la contrainte de clé étrangère
            $table->dropForeign(['id_demande']);

            // Supprimer la colonne id_demande
            $table->dropColumn('id_demande');
        });
    }
}