<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveQuantiteFromDispatchingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dispatchings', function (Blueprint $table) {
            $table->dropColumn('quantite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dispatchings', function (Blueprint $table) {
            $table->integer('quantite')->after('id'); // Ajoutez la colonne après 'id' ou à l'emplacement souhaité
        });
    }
}