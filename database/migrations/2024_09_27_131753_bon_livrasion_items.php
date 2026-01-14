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
        Schema::create('bon_livraison_items', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('imei')->nullable();
            $table->string('nr_cart_sim')->nullable();
            $table->unsignedBigInteger('bon_livraison_id')->nullable();
            $table->foreign('bon_livraison_id')
            ->references('id')
            ->on('bon_livraison')
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
        Schema::dropIfExists('bon_livraison_items');
    }
};
