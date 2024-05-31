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
        Schema::create('classe_matieres', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_classe');
            $table->foreign('id_classe')->references('id')->on('classes');

            $table->unsignedBigInteger('id_matiere');
            $table->foreign('id_matiere')->references('id')->on('matieres');
             
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe_matieres');
    }
};
