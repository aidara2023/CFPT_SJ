<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKeysFromMaterielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materiels', function (Blueprint $table) {
            // Suppression des clés étrangères
            $table->dropForeign(['id_stock']);
            $table->dropForeign(['id_service']);

            // Suppression des colonnes
            $table->dropColumn('id_stock');
            $table->dropColumn('id_service');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materiels', function (Blueprint $table) {
            // Recréation des colonnes
            $table->unsignedBigInteger('id_stock')->nullable();
            $table->unsignedBigInteger('id_service')->nullable();

            // Réassociation des clés étrangères
            $table->foreign('id_stock')->references('id')->on('stocks')->onDelete('cascade');
            $table->foreign('id_service')->references('id')->on('services')->onDelete('cascade');
        });
    }
}

