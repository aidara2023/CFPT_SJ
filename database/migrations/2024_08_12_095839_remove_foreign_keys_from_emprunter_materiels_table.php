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
        Schema::table('emprunter_materiels', function (Blueprint $table) {
            //
             // Suppression des clés étrangères
             $table->dropForeign(['id_date_emprunter']);
             
 
             // Suppression des colonnes
             $table->dropColumn('id_date_emprunter');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emprunter_materiels', function (Blueprint $table) {
            //
        });
    }
};
