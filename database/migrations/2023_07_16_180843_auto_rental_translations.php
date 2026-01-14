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
        Schema::create('auto_rental_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->nullable();
            $table->string('name_de')->nullable();
            $table->string('fuel_en')->nullable();
            $table->string('fuel_de')->nullable();
            $table->string('mileage_en')->nullable();
            $table->string('mileage_de')->nullable();
            $table->string('transmission_en')->nullable();
            $table->string('transmission_de')->nullable();
            $table->string('performance_en')->nullable();
            $table->string('performance_de')->nullable();
            $table->string('seats_en')->nullable();
            $table->string('seats_de')->nullable();
            $table->string('doors_en')->nullable();
            $table->string('doors_de')->nullable();
            $table->string('description_en')->nullable();
            $table->string('description_de')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->foreign('model_id')
            ->references('id')
            ->on('auto_rental')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto_rental_translations');
    }
};
