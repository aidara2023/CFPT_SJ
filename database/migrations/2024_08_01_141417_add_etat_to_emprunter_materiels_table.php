<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEtatToEmprunterMaterielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emprunter_materiels', function (Blueprint $table) {
            $table->enum('etat', ['emprunté', 'retourné', 'en retard'])->default('emprunté'); // ajout de la colonne 'etat'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emprunter_materiels', function (Blueprint $table) {
            $table->dropColumn('etat'); // suppression de la colonne 'etat'
        });
    }
}
