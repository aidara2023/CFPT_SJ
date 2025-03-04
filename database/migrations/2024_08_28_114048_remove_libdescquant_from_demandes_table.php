<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveLibdescquantFromDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {
            if (Schema::hasColumn('demandes', 'libelle')) {
                $table->dropColumn('libelle');
            }
            if (Schema::hasColumn('demandes', 'quantite')) {
                $table->dropColumn('quantite');
            }
            if (Schema::hasColumn('demandes', 'description')) {
                $table->dropColumn('description');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->string('libelle')->nullable();
            $table->integer('quantite')->nullable();
            $table->text('description')->nullable();
        });
    }
}