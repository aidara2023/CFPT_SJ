<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SimplifyDemandeItemsStock extends Migration
{
    public function up()
    {
        // Supprimer les tables pivot qui compliquent les choses
        Schema::dropIfExists('demande_stock_materiel');
        Schema::dropIfExists('demande_stock_consommable');

        // Simplifier demande_materiels
        Schema::table('demande_materiels', function (Blueprint $table) {
            $table->boolean('a_commander')->default(false);
        });

        // Simplifier demande_consommables
        Schema::table('demande_consommables', function (Blueprint $table) {
            $table->boolean('a_commander')->default(false);
        });
    }

    public function down()
    {
        // Recréer les tables pivot
        Schema::create('demande_stock_materiel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_id')->constrained('demandes')->onDelete('cascade');
            $table->foreignId('stock_materiel_id')->constrained('stock_materiels')->onDelete('cascade');
            $table->integer('quantite_demandee');
            $table->integer('quantite_disponible');
            $table->timestamps();
        });

        Schema::create('demande_stock_consommable', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_id')->constrained('demandes')->onDelete('cascade');
            $table->foreignId('stock_consommable_id')->constrained('stock_consommables')->onDelete('cascade');
            $table->integer('quantite_demandee');
            $table->integer('quantite_disponible');
            $table->timestamps();
        });

        // Supprimer les colonnes ajoutées
        Schema::table('demande_materiels', function (Blueprint $table) {
            $table->dropColumn('a_commander');
        });

        Schema::table('demande_consommables', function (Blueprint $table) {
            $table->dropColumn('a_commander');
        });
    }
}
