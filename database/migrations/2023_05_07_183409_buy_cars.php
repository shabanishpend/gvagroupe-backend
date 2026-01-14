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
        Schema::create('buy_cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price')->nullable();
            $table->string('fuel')->nullable();
            $table->string('mileage')->nullable();
            $table->string('transmission')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('address')->nullable();
            $table->string('performance')->nullable();
            $table->string('seats')->nullable();
            $table->string('doors')->nullable();
            $table->string('year')->nullable();
            $table->string('status')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();
            $table->string('image_5')->nullable();
            $table->string('image_6')->nullable();
            $table->string('image_7')->nullable();
            $table->string('image_8')->nullable();
            $table->string('image_9')->nullable();
            $table->string('image_10')->nullable();
            // Added later
            $table->string('chasie_number')->nullable();
            $table->boolean('expertise')->nullable();
            $table->string('color')->nullable();
            $table->string('carroserie')->nullable();
            $table->integer('carroserie_code')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('type_approval')->nullable();
            $table->string('cilindre')->nullable();
            $table->string('power_kw')->nullable();
            $table->string('weight_no_loaded')->nullable();
            $table->string('weight_loaded')->nullable();
            $table->string('weight_full_loaded')->nullable();
            $table->string('roof_weight')->nullable();
            $table->string('emission_code')->nullable();
            //End of later fields added
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('buy_cars_marks_id')->nullable();
            $table->foreign('buy_cars_marks_id')
            ->references('id')
            ->on('buy_cars_marks')
            ->onDelete('cascade');
            $table->unsignedBigInteger('buy_cars_models_id')->nullable();
            $table->foreign('buy_cars_models_id')
            ->references('id')
            ->on('buy_cars_models')
            ->onDelete('cascade');
            $table->unsignedBigInteger('buy_cars_category')->nullable();
            $table->foreign('buy_cars_category')
            ->references('id')
            ->on('buy_cars_categories')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buy_cars');
    }
};
