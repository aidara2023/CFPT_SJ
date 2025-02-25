<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {
            // Ajoute la colonne id_commande
            $table->unsignedBigInteger('id_commande')->nullable();
            
            // Ajoute la clé étrangère
            $table->foreign('id_commande')->references('id')->on('commandes')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('demandes', function (Blueprint $table) {
            // Supprime la clé étrangère
            $table->dropForeign(['id_commande']);
            
            // Supprime la colonne id_commande
            $table->dropColumn('id_commande');
        });
    }
};