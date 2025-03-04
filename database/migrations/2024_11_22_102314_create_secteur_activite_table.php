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
        Schema::create('secteur_activite', function (Blueprint $table) {
            $table->id(); // Crée une colonne 'id' auto-incrémentée
            $table->string('nom'); // Colonne 'nom'
            $table->text('description')->nullable(); // Colonne 'description' nullable
            $table->timestamps(); // Colonne pour les timestamps (created_at, updated_at)
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('secteur_activite');
    }
};
