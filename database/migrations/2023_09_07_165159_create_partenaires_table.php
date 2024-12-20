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
        Schema::create('partenaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom_partenaire');
            $table->string('type');
            $table->string('description');
            $table->string('contact');
            $table->string('email');
            $table->string('adresse');
            $table->string('boite_postale');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->unsignedBigInteger('id_direction');
            $table->foreign('id_direction')->references('id')->on('directions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partenaires');
    }
};
