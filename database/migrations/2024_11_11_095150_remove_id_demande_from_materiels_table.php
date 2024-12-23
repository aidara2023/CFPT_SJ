<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIdDemandeFromMaterielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materiels', function (Blueprint $table) {
            $table->dropForeign(['id_demande']);
            $table->dropColumn('id_demande');
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
            $table->unsignedBigInteger('id_demande')->nullable()->after('id_type_materiel');
            $table->foreign('id_demande')->references('id')->on('demandes')->onDelete('set null');
        });
    }
}