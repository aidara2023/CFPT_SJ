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
        Schema::create('paiement_partenaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_facture');
            $table->foreign('id_facture')->references('id')->on('factures')->onUpdate('cascade')->onDelete('cascade');
            $table->float('montant_payer');
            $table->string('mode_paiement');
            $table->date('date_paiement');
            $table->timestamps();

            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiement_partenaires');
    }
};
