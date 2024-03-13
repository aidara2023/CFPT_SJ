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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->longText('designation');
            $table->integer('nombre_jour')->nullable();
            $table->integer('montant_jour')->nullable();
            $table->string('date_location')->nullable();

            $table->boolean('reserver')->default(false);

            $table->unsignedBigInteger('id_partenaire')->nullable();
            $table->foreign('id_partenaire')->references('id')->on('partenaires')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('id_salle')->nullable();
            $table->foreign('id_salle')->references('id')->on('salles')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
