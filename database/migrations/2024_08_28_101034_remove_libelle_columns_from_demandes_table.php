<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveLibelleColumnsFromDemandesTable extends Migration
{
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->dropColumn('libelle_materiel');
            $table->dropColumn('libelle_consommable');
        });
    }

    public function down()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->string('libelle_materiel')->nullable();
            $table->string('libelle_consommable')->nullable();
        });
    }
}
