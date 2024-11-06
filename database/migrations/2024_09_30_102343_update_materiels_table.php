<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMaterielsTable extends Migration
{
    public function up()
    {
        Schema::table('materiels', function (Blueprint $table) {
            // Supprimer la contrainte de clé étrangère pour id_statut
            $table->dropForeign(['id_statut']); // Assurez-vous que le nom de la contrainte est correct

            // Supprimer la colonne id_statut
            $table->dropColumn('id_statut');

            // Ajouter la colonne id_etat
            $table->unsignedBigInteger('id_etat')->nullable(); 
            // Si vous avez une table etat, vous pouvez ajouter une contrainte de clé étrangère
            $table->foreign('id_etat')->references('id')->on('etats')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('materiels', function (Blueprint $table) {
            // Ajouter la colonne id_statut
            $table->unsignedBigInteger('id_statut')->nullable()->after('id_etat');

            // Supprimer la colonne id_etat
            $table->dropForeign(['id_etat']); // Supprimer la contrainte de clé étrangère
            $table->dropColumn('id_etat');
        });
    }
}