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
        Schema::create('quittances', function (Blueprint $table) {
            $table->id();
            $table->string('date_emis');
            $table->string('date_imprime');
            $table->string('status')->nullable();
            $table->float('montant');
            $table->string('numero')->unique();
            $table->unsignedBigInteger('id_eleve');
            $table->foreign('id_eleve')->references('id')->on('eleves')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quittances');
    }
};