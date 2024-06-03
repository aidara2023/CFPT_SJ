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
        Schema::create('unite_de_formations', function (Blueprint $table) {
            $table->id();
            $table->string('nom_unite_formation');
           // $table->unsignedBigInteger('id_formateur');
            $table->unsignedBigInteger('id_departement');
            //$table->foreign('id_formateur')->references('id')->on('formateurs');
            $table->foreign('id_departement')->references('id')->on('departements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unite_de_formations');
    }
};
