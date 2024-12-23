<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id(); // ID de la commande
            $table->string('reference_commande')->unique(); // Référence de la commande
            
            $table->unsignedBigInteger('id_demande')->nullable(); 
            $table->foreign('id_demande')->references('id')->on('demandes')->onDelete('cascade');
            $table->unsignedBigInteger('id_fournisseur')->nullable(); 
            $table->foreign('id_fournisseur')->references('id')->on('fournisseurs')->onDelete('cascade');
            $table->date('date_commande'); // Date de la commande
            $table->enum('statut', ['envoyé', 'livré', 'non livré']); // Statut de la commande
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}