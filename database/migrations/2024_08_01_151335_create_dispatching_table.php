<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatching', function (Blueprint $table) {
            $table->id(); // id auto-incrémenté
            $table->integer('quantite'); // quantité
            
            // clés étrangères
            $table->unsignedBigInteger('id_departement');
            $table->unsignedBigInteger('id_salle');
            $table->unsignedBigInteger('id_materiel');

            // Définir les relations des clés étrangères
            $table->foreign('id_departement')->references('id')->on('departements')->onDelete('cascade');
            $table->foreign('id_salle')->references('id')->on('salles')->onDelete('cascade');
            $table->foreign('id_materiel')->references('id')->on('materiels')->onDelete('cascade');

            $table->timestamps(); // timestamps created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispatching');
    }
}
