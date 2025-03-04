<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLibdescquantToDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {
            if (!Schema::hasColumn('demandes', 'libelle')) {
                $table->string('libelle')->nullable();
            }
            if (!Schema::hasColumn('demandes', 'quantite')) {
                $table->integer('quantite')->nullable();
            }
            if (!Schema::hasColumn('demandes', 'description')) {
                $table->text('description')->nullable();
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
}

