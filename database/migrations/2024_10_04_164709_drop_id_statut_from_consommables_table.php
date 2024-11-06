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
            // Supprimer la contrainte de clé étrangère pour id_statut
            $table->dropForeign(['id_statut']); // Assurez-vous que le nom de la contrainte est correct

            // Supprimer la colonne id_statut
            $table->dropColumn('id_statut');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consommables', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('id_statut')->nullable();
        });
    }
};
