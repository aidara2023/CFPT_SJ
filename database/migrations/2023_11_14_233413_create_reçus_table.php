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
        Schema::create('reçus', function (Blueprint $table) {
            $table->id();
            $table->string('date_emis');
            $table->string('date_imprime');
            $table->string('status')->nullable();
            $table->string('reference')->nullable();
            $table->float('relliquat');
            $table->string('numero_operation')->unique();
            $table->unsignedBigInteger('id_paiement');
            $table->foreign('id_paiement')->references('id')->on('paiements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reçus');
    }
};
