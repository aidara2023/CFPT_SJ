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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            $table->float('note_obtenue');
            $table->date('date_enregistrer');
            $table->string('appreciation');
            $table->string('observation');
            $table->unsignedBigInteger('id_eleve');
            $table->foreign('id_eleve')->references('id')->on('eleves')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_formateur');
            $table->foreign('id_formateur')->references('id')->on('formateurs')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_matiere');
            $table->foreign('id_matiere')->references('id')->on('matieres')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_type_evaluation');
            $table->foreign('id_type_evalution')->references('id')->on('type_evaluations')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_semestre');
            $table->foreign('id_semestre')->references('id')->on('semestres')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_annee_academique');
            $table->foreign('id_annee_academique')->references('id')->on('annee_academiques')->onUpdate('cascade')->onDelete('cascade');




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
