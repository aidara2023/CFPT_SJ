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
        Schema::create('cahier_de_texte', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('intitule');
            $table->longText('contenu');
            $table->unsignedBigInteger('id_cour');
            $table->foreign('id_cour')->references('id')->on('cours');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cahier_de_texte');
    }
};
