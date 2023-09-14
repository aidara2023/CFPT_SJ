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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_infirmier');
            $table->unsignedBigInteger('id_dossier_medical');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_infirmier')->references('id')->on('infirmiers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_dossier_medical')->references('id')->on('dossier_medicals')->onUpdate('cascade')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
