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
        Schema::create('livres', function (Blueprint $table) {
            $table->id();
            $table->string('titre_livre');
            $table->unsignedBigInteger('id_categorie');
            $table->unsignedBigInteger('id_auteur');
            $table->unsignedBigInteger('id_edition');
            $table->foreign('id_categorie')->references('id')->on('categories');
            $table->foreign('id_auteur')->references('id')->on('auteurs');
            $table->foreign('id_edition')->references('id')->on('editions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livres');
    }
};
