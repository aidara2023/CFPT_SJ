
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIdUniteDeFormationFromMaterielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materiels', function (Blueprint $table) {
            // Suppression de la clé étrangère d'abord
            $table->dropForeign(['id_unite_de_formation']);

            // Puis suppression de la colonne
            $table->dropColumn('id_unite_de_formation');
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
            // Ajout de la colonne
            $table->unsignedBigInteger('id_unite_de_formation');

            // Ré-ajout de la clé étrangère
            $table->foreign('id_unite_de_formation')->references('id')->on('unite_de_formation')->onDelete('cascade');
        });
    }
}
