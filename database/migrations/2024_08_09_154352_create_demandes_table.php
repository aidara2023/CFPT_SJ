<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id(); 
            $table->integer('quantite'); // Crée une colonne "quantite" de type INTEGER
            $table->unsignedBigInteger('id_user'); // Crée une colonne "id_user" de type BIGINT pour la clé étrangère
            $table->unsignedBigInteger('id_materiel')->nullable(); // Crée une colonne "id_materiel" de type BIGINT nullable
            $table->unsignedBigInteger('id_consommable')->nullable(); // Crée une colonne "id_consommable" de type BIGINT nullable

            
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_materiel')->references('id')->on('materiels')->onDelete('cascade');
            $table->foreign('id_consommable')->references('id')->on('consommables')->onDelete('cascade');

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandes');
    }
}

