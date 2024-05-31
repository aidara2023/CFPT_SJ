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
        Schema::create('ressource_pedagogiques', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('contenu');
            $table->unsignedBigInteger('id_formateur');
            $table->foreign('id_formateur')->references('id')->on('formateurs');
            $table->unsignedBigInteger('id_unite_de_formation');
            $table->foreign('id_unite_de_formation')->references('id')->on('unite_de_formations');
           /*  $table->unsignedBigInteger('id_eleve');
            $table->foreign('id_eleve')->references('id')->on('eleves'); */
            $table->unsignedBigInteger('id_cour');
            $table->foreign('id_cour')->references('id')->on('cours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ressource_pedagogiques');
    }
};
