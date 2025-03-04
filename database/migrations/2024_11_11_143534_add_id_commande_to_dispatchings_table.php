<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdCommandeToDispatchingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dispatchings', function (Blueprint $table) {
            $table->unsignedBigInteger('id_commande')->nullable()->after('id'); // Ajoute la colonne
            $table->foreign('id_commande')->references('id')->on('commandes')->onDelete('set null'); // Ajoute la clé étrangère
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
            $table->dropForeign(['id_commande']); // Supprime la clé étrangère
            $table->dropColumn('id_commande'); // Supprime la colonne
        });
    }
}