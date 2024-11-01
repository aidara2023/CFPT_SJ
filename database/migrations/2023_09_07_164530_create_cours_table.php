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
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->date('date_cour');
            $table->unsignedBigInteger('id_classe');
            $table->foreign('id_classe')->references('id')->on('classes');
            $table->unsignedBigInteger('id_formateur');
            $table->foreign('id_formateur')->references('id')->on('formateurs');
            $table->unsignedBigInteger('id_matiere');
            $table->foreign('id_matiere')->references('id')->on('matieres');
            $table->unsignedBigInteger('id_salle');
            $table->foreign('id_salle')->references('id')->on('salles');
            $table->unsignedBigInteger('id_semestre');
            $table->foreign('id_semestre')->references('id')->on('semestres');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours');
    }
};
