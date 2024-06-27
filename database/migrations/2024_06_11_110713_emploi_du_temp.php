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
        Schema::create('emploi_du_temps', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_cour');
            $table->foreign('id_cour')->references('id')->on('cours');

            $table->unsignedBigInteger('id_annee_academique');
            $table->foreign('id_annee_academique')->references('id')->on('annee_academiques');
            
            $table->date('date_debut');
            $table->date('date_fin');


            $table->timestamps();
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
