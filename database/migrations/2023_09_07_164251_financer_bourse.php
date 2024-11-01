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
        Schema::create('financer_bourses', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('montant');
            $table->unsignedBigInteger('id_organisme');
            $table->unsignedBigInteger('id_eleve');
            $table->unsignedBigInteger('id_classe');
            $table->unsignedBigInteger('id_annee_academique');
            $table->foreign('id_organisme')->references('id')->on('organismes');
            $table->foreign('id_eleve')->references('id')->on('eleves');
            $table->foreign('id_classe')->references('id')->on('classes');
            $table->foreign('id_annee_academique')->references('id')->on('annee_academiques');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financer_bourses');
    }
};
