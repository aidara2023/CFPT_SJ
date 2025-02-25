<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIdCommandeFromConsommablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consommables', function (Blueprint $table) {
            
            $table->dropColumn('id_commande'); // Supprime la colonne
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consommables', function (Blueprint $table) {
            $table->unsignedBigInteger('id_commande')->nullable()->after('id'); // Ajoute la colonne
            
        });
    }
}