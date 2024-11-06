<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatchings', function (Blueprint $table) {
            $table->id();
            $table->integer('quantite');
            $table->unsignedBigInteger('id_departement')->nullable();
            $table->unsignedBigInteger('id_salle')->nullable();
            $table->unsignedBigInteger('id_materiel')->nullable();
            $table->unsignedBigInteger('id_consommable')->nullable();
            $table->unsignedBigInteger('id_batiment')->nullable();
            $table->unsignedBigInteger('id_demande')->nullable();
            $table->timestamps();

            // Clés étrangères
            $table->foreign('id_departement')->references('id')->on('departements')->onDelete('set null');
            $table->foreign('id_salle')->references('id')->on('salles')->onDelete('set null');
            $table->foreign('id_materiel')->references('id')->on('materiels')->onDelete('set null');
            $table->foreign('id_consommable')->references('id')->on('consommables')->onDelete('set null');
            $table->foreign('id_batiment')->references('id')->on('batiments')->onDelete('set null');
            $table->foreign('id_demande')->references('id')->on('demandes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispatchings');
    }
}