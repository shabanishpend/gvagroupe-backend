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
        Schema::create('clients_cars', function (Blueprint $table) {
            $table->id();
            $table->string('nr_plaques')->nullable();
            $table->string('km_voiture')->nullable();
            $table->string('pu_kw')->nullable();
            $table->string('annee')->nullable();
            $table->string('marque')->nullable();
            $table->string('type')->nullable();
            $table->string('chassis')->nullable();
            $table->string('hml')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients_cars');
    }
};
