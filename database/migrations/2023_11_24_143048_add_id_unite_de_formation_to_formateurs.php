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
        Schema::table('formateurs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_unite_de_formation')->nullable();
            $table->foreign('id_unite_de_formation')->references('id')->on('unite_de_formations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formateurs', function (Blueprint $table) {
            //
        });
    }
};
