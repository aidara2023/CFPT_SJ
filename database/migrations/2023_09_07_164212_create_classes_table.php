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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('nom_classe');
            $table->string('type_classe');
            $table->string('niveau');
            $table->unsignedBigInteger('id_type_formation');
            $table->unsignedBigInteger('id_unite_de_formation');
            $table->foreign('id_type_formation')->references('id')->on('type_formations');
            $table->foreign('id_unite_de_formation')->references('id')->on('unite_de_formations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
