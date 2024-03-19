<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{ public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('date_debut');
            $table->string('date_fin');
            $table->unsignedBigInteger('id_salle')->nullable();
            $table->foreign('id_salle')->references('id')->on('salles')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_location')->nullable();
            $table->foreign('id_location')->references('id')->on('locations')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
    
    
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
