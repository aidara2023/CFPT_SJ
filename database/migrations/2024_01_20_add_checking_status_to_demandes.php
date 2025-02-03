<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->enum('checking_status', ['non_verifié', 'disponible', 'partiellement_disponible', 'non_disponible'])
                  ->default('non_verifié')
                  ->after('statut');
        });
    }

    public function down()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->dropColumn('checking_status');
        });
    }
};
