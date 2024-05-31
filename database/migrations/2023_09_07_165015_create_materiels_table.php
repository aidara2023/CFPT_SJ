<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materiels', function (Blueprint $table) {
            $table->id();
            $table->string('nom_materiel');
            $table->date('date-entree');
            $table->date('date_sortie');
            $table->string('etat');
            $table->string('quantite');
            $table->unsignedBigInteger('id_service');
            $table->foreign('id_service')->references('id')->on('services');
            $table->unsignedBigInteger('id_salle');
            $table->foreign('id_salle')->references('id')->on('salles');
            $table->unsignedBigInteger('id_type_materiel');
            $table->foreign('id_type_materiel')->references('id')->on('type_materiels');
            $table->unsignedBigInteger('id_statut');
            $table->foreign('id_statut')->references('id')->on('statuts');
            $table->unsignedBigInteger('id_unite_de_formation');
            $table->foreign('id_unite_de_formation')->references('id')->on('unite_de_formations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiels');
    }
};
