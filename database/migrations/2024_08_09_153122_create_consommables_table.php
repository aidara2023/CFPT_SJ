<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsommablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consommables', function (Blueprint $table) {
            $table->id(); 
            $table->string('libelle'); 
            $table->string('marque'); // Crée une colonne "marque" de type VARCHAR
            $table->integer('quantite'); // Crée une colonne "quantite" de type INTEGER
            $table->date('date_entree'); // Crée une colonne "date_entree" de type DATE
            $table->unsignedBigInteger('id_statut'); // Crée une colonne "id_statut" de type BIGINT pour la clé étrangère
            $table->unsignedBigInteger('id_departement'); // Crée une colonne "id_departement" de type BIGINT pour la clé étrangère

            // Définir les clés étrangères
            $table->foreign('id_statut')->references('id')->on('statuts')->onDelete('cascade');
            $table->foreign('id_departement')->references('id')->on('departements')->onDelete('cascade');

            $table->timestamps(); // Crée les colonnes "created_at" et "updated_at"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consommables');
    }
}

