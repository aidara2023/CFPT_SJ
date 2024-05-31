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
        Schema::create('emprunter_livres', function (Blueprint $table) {
            $table->id();
            $table->date('date_emprunter');
            $table->date('date_retour');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_bibliothecaire');
            $table->unsignedBigInteger('id_exemplaire');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_bibliothecaire')->references('id')->on('bibliothecaires');
            $table->foreign('id_exemplaire')->references('id')->on('exemplaires');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprunter_livres');
    }
};
