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
        Schema::table('unite_de_formations', function (Blueprint $table) {
            $table->dropForeign('unite_de_formations_id_formateur_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unite_de_formations', function (Blueprint $table) {
            $table->foreignId('id_formateur')->constrained('formateur');
        });
    }
};
