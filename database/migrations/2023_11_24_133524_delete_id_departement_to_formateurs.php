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
        Schema::table('formateurs', function (Blueprint $table) {
            $table->dropForeign('formateurs_id_departement_foreign');
            $table->dropColumn('id_departement');
        });
    }

    /**

    * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formateurs', function (Blueprint $table) {
            $table->foreignId('id_departement')->constrained('formateurs');
        });
    }
};
