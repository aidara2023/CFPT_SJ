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
        Schema::create('exemplaires', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            $table->timestamps();
            $table->unsignedBigInteger('id_livre');
            $table->unsignedBigInteger('id_rayon');
            $table->foreign('id_livre')->references('id')->on('livres')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_rayon')->references('id')->on('rayons')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exemplaires');
    }
};
