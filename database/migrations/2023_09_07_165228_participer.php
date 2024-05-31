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
        Schema::create('participers', function (Blueprint $table) {
            $table->id();
            $table->date('date_participation');
            $table->unsignedBigInteger('id_seminaire');
            $table->foreign('id_seminaire')->references('id')->on('seminaires');
            $table->unsignedBigInteger('id_formateur');
            $table->foreign('id_formateur')->references('id')->on('formateurs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participers');
    }
};
