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
        Schema::create('stock', function (Blueprint $table) {
            $table->id(); // id auto-incrémenté
            $table->string('nomMaterielStock'); // nom du matériel en stock
            $table->integer('quantite_reelle'); // quantité réelle
            $table->timestamps(); // timestamps created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};
