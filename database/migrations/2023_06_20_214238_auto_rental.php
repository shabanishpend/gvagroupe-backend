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
        Schema::create('auto_rental', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 9, 3)->nullable();
            $table->string('fuel')->nullable();
            $table->string('location')->nullable();
            $table->string('mileage')->nullable();
            $table->string('transmission')->nullable();
            $table->string('performance')->nullable();
            $table->string('seats')->nullable();
            $table->string('doors')->nullable();
            $table->string('year')->nullable();
            $table->string('status')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->date('date_from')->nullable();
            $table->time('time_from')->nullable();
            $table->date('date_to')->nullable();
            $table->time('time_to')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto_rental');
    }
};
