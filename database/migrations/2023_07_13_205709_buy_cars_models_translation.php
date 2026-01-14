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
        Schema::create('buy_cars_models_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->nullable();
            $table->string('description_en')->nullable();
            $table->string('name_de')->nullable();
            $table->string('description_de')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->foreign('model_id')
            ->references('id')
            ->on('buy_cars_models')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buy_cars_models_translations');
    }
};
