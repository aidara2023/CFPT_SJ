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
        Schema::create('formateur_matieres', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_matiere');
            $table->foreign('id_matiere')->references('id')->on('matieres');

            $table->unsignedBigInteger('id_formateur')->nullable();
            $table->foreign('id_formateur')->references('id')->on('formateurs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formateur_matieres');
    }
};
