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
        Schema::create('concerners', function (Blueprint $table) {
            $table->id();
            $table->boolean('statut');
            $table->unsignedBigInteger('id_paiement');
            $table->foreign('id_paiement')->references('id')->on('paiements')->onUpdate('cascade')->onDelete('cascade');
             $table->unsignedBigInteger('id_mois');
            $table->foreign('id_mois')->references('id')->on('mois')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('concerners');
    }
};
