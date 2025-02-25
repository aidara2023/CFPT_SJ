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
        Schema::table('commandes', function (Blueprint $table) {
            // Supprime la clé étrangère
            $table->dropForeign(['id_fournisseur']);
            
            // Supprime la colonne id_fournisseur
            $table->dropColumn('id_fournisseur');
        });
    }
    
    public function down()
    {
        Schema::table('commandes', function (Blueprint $table) {
            // Ajoute à nouveau la colonne id_fournisseur si besoin
            $table->unsignedBigInteger('id_fournisseur')->nullable();
            
            // Ajoute la clé étrangère
            $table->foreign('id_fournisseur')->references('id')->on('fournisseurs')->onDelete('set null');
        });
    }
};
