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
        Schema::create('formateurs', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('situation_matrimoniale');
            $table->unsignedBigInteger('id_specialite');
            //$table->unsignedBigInteger('id_departement');
            $table->foreign('id_specialite')->references('id')->on('specialites');
            //$table->foreign('id_departement')->references('id')->on('departements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formateurs');
    }
};
