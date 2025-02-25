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
        Schema::table('consommables', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('id_etat')->nullable(); 
            // Si vous avez une table etat, vous pouvez ajouter une contrainte de clé étrangère
            $table->foreign('id_etat')->references('id')->on('etats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consommables', function (Blueprint $table) {
            //
            $table->dropForeign(['id_etat']); // Supprimer la contrainte de clé étrangère
            $table->dropColumn('id_etat');
        });
    }
};
