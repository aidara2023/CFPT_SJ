<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMaterielsTable extends Migration
{
    public function up()
    {
        Schema::create('stock_materiels', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('marque');
            $table->integer('quantite_disponible');

            $table->unsignedBigInteger('id_type_materiel')->nullable(); // Ajoute la colonne secteur_activite_id
    
            // Ajoute la clé étrangère
            $table->foreign('id_type_materiel')->references('id')->on('type_materiels');

            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_materiels');
    }
}