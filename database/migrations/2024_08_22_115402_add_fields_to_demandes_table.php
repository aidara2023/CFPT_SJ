<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->string('type_demande'); // 'materiel', 'consommable', 'both'
            $table->integer('quantite_materiel')->nullable();
            $table->integer('quantite_consommable')->nullable();
            $table->text('description_materiel')->nullable();  
            $table->text('description_consommable')->nullable(); 
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
            $table->dropColumn(['type_demande', 'quantite_materiel', 'quantite_consommable', 'description_materiel', 'description_consommable']);
        });
    }
}
