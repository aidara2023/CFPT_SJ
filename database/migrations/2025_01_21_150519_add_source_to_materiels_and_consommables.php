<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSourceToMaterielsAndConsommables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materiels', function (Blueprint $table) {
            $table->enum('source', ['stock', 'commande'])->nullable()->after('id_commande');
        });

        Schema::table('consommables', function (Blueprint $table) {
            $table->enum('source', ['stock', 'commande'])->nullable()->after('id_commande');
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
            $table->dropColumn('source');
        });

        Schema::table('consommables', function (Blueprint $table) {
            $table->dropColumn('source');
        });
    }
}
