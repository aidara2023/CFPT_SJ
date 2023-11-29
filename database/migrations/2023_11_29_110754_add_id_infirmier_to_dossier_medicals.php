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
        Schema::table('dossier_medicals', function (Blueprint $table) {
            //
            $table->text('antecedents')->nullable();
            $table->text('diagnostics')->nullable();
            $table->text('traitements')->nullable();
            $table->text('resultats_tests')->nullable();
            $table->unsignedBigInteger('id_infirmier');
            $table->foreign('id_infirmier')->references('id')->on('infirmiers')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dossier_medicals', function (Blueprint $table) {
            //
        });
    }
};
