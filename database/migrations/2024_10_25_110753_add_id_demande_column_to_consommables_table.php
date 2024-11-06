<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdDemandeColumnToConsommablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consommables', function (Blueprint $table) {
            $table->unsignedBigInteger('id_demande')->nullable()->after('id'); // Ajoutez 'after' pour spécifier la position
            $table->foreign('id_demande')->references('id')->on('demandes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consommables', function (Blueprint $table) {
            $table->dropForeign(['id_demande']);
            $table->dropColumn('id_demande');
        });
    }
}