<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            $table->text('adresse')->nullable();
            $table->string('secteur_activite', 100)->nullable();
            $table->text('produits_services')->nullable();
            $table->string('nom_contact', 100)->nullable();
            $table->string('telephone_contact', 20)->nullable();
            $table->enum('statut', ['actif', 'inactif'])->default('actif');
        });
    }
    
    public function down()
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            $table->dropColumn([
                'adresse',
                'secteur_activite',
                'produits_services',
                'nom_contact',
                'telephone_contact',
                'statut'
            ]);
        });
    }
};
