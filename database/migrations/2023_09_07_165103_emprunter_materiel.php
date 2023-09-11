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
        Schema::create('emprunter_materiels', function (Blueprint $table) {
            $table->id();
            $table->date('date_retour_prevue');
            $table->date('date_retour_effective');
            $table->string('statut');
            $table->unsignedBigInteger('id_materiel');
            $table->foreign('id_materiel')->references('id')->on('materiels')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_date_emprunter');
            $table->foreign('id_date_emprunter')->references('id')->on('date_emprunters')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprunter_materiels');
    }
};
