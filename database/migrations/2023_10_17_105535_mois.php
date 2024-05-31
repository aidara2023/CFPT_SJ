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
        Schema::create('mois', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            /* $table->unsignedBigInteger('id_annee_academique');
            $table->foreign('id_annee_academique')->references('id')->on('annee_academiques'); */
        

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
