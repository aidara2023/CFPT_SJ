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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('montant');
            $table->date('date_inscription');
            $table->unsignedBigInteger('id_eleve');
            $table->unsignedBigInteger('id_classe');
            $table->unsignedBigInteger('id_annee_academique');
            $table->foreign('id_eleve')->references('id')->on('eleves')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_classe')->references('id')->on('classes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_annee_academique')->references('id')->on('annee_academiques')->onUpdate('cascade')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
