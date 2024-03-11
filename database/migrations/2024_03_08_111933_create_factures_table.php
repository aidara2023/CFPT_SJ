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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('objet')->nullable();
            $table->double('montant_payer')->nullable();
            $table->double('date_facture')->nullable();

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
        Schema::dropIfExists('factures');
    }
};
