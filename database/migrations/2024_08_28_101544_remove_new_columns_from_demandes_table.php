<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {
            
            $table->dropColumn('description_materiel');
            $table->dropColumn('description_consommable');
            $table->dropColumn('quantite_materiel');
            $table->dropColumn('quantite_consommable');
        });
    }

    public function down()
    {
        Schema::table('demandes', function (Blueprint $table) {
           
        });
    }
};
