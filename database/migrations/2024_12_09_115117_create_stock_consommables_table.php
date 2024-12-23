<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockConsommablesTable extends Migration
{
    public function up()
    {
        Schema::create('stock_consommables', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('marque');
            $table->integer('quantite_disponible');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_consommables');
    }
}