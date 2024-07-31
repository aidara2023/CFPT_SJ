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
        Schema::table('cours', function (Blueprint $table) {
        /*     $table->dropColumn('date_cour');
            $table->dropColumn('heure_debut');
            $table->dropColumn('heure_fin'); */
           // $table->dropColumn('id_salle');
            $table->dropForeign(['id_salle']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cours', function (Blueprint $table) {
         /*    $table->date('date_cour');
            $table->string('heure_debut');
            $table->string('heure_fin'); */
           $table->foreign('id_salle')->references('id')->on('salles')->onDelete('cascade');

        });
    }
};
