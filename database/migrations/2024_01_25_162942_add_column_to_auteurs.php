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
        Schema::table('auteurs', function (Blueprint $table) {
            //
            $table->string('prenom');
            $table->string('date_naissance')->nullable();
            $table->text('biographie');
            $table->string('nationalite');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('auteurs', function (Blueprint $table) {
            //
        });
    }
};
