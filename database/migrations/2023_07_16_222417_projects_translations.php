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
        Schema::create('projets_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();
            $table->string('title_de')->nullable();
            $table->string('service_en')->nullable();
            $table->string('service_de')->nullable();
            $table->string('content_en')->nullable();
            $table->string('content_de')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->foreign('model_id')
            ->references('id')
            ->on('projects')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets_translations');
    }
};
