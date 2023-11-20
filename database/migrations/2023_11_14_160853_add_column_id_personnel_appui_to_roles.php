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
        Schema::table('roles', function (Blueprint $table) {
           
                $table->unsignedBigInteger('id_personnel_appui')->nullable();
                $table->foreign('id_personnel_appui')->references('id')->on('personnel_appuis')->onUpdate('cascade')->onDelete('cascade');
            });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            //
        });
    }
};
