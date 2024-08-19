<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLibelleAndMarqueToMaterielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materiels', function (Blueprint $table) {
            $table->string('libelle');
            $table->string('marque');
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
            $table->dropColumn('libelle');
            $table->dropColumn('marque');
        });
    }
}
