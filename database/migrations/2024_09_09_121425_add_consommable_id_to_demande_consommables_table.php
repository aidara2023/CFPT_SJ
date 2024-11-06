<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConsommableIdToDemandeConsommablesTable extends Migration
{
    public function up()
    {
        Schema::table('demande_consommables', function (Blueprint $table) {
            $table->unsignedBigInteger('consommable_id')->nullable()->after('id_demande');
            $table->foreign('consommable_id')->references('id')->on('consommables')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('demande_consommables', function (Blueprint $table) {
            $table->dropForeign(['consommable_id']);
            $table->dropColumn('consommable_id');
        });
    }
}