<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaterielIdToDemandeMaterielsTable extends Migration
{
    public function up()
    {
        Schema::table('demande_materiels', function (Blueprint $table) {
            $table->unsignedBigInteger('materiel_id')->nullable()->after('id_demande');
            $table->foreign('materiel_id')->references('id')->on('materiels')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('demande_materiels', function (Blueprint $table) {
            $table->dropForeign(['materiel_id']);
            $table->dropColumn('materiel_id');
        });
    }
}