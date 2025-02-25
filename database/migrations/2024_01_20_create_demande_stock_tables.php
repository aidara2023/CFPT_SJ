<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('demande_stock_materiel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_id')->constrained()->onDelete('cascade');
            $table->foreignId('stock_materiel_id')->constrained()->onDelete('cascade');
            $table->integer('quantite_demandee');
            $table->integer('quantite_disponible')->default(0);
            $table->timestamps();
        });

        Schema::create('demande_stock_consommable', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_id')->constrained()->onDelete('cascade');
            $table->foreignId('stock_consommable_id')->constrained()->onDelete('cascade');
            $table->integer('quantite_demandee');
            $table->integer('quantite_disponible')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('demande_stock_materiel');
        Schema::dropIfExists('demande_stock_consommable');
    }
};
