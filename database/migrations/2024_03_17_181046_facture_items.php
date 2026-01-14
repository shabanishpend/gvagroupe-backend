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
        Schema::create('factures_items', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->decimal('prix_unitaire')->nullable();
            $table->string('quantity')->nullable();
            $table->string('total_chf')->nullable();
            $table->unsignedBigInteger('facture_id')->nullable();
            $table->foreign('facture_id')
            ->references('id')
            ->on('factures')
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
        Schema::dropIfExists('factures_items');
    }
};
