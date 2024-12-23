<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIdDemandeFromDispatchingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dispatchings', function (Blueprint $table) {
            $table->dropForeign(['id_demande']); // Supprime la clé étrangère
            $table->dropColumn('id_demande'); // Supprime la colonne
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
            $table->unsignedBigInteger('id_demande')->nullable()->after('id'); // Ajoute la colonne
            $table->foreign('id_demande')->references('id')->on('demandes')->onDelete('set null'); // Ajoute la clé étrangère
        });
    }
}