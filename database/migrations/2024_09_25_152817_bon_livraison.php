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
        Schema::create('bon_livraison', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('number_de_bon')->nullable();
            $table->string('article')->nullable();
            $table->string('website')->nullable();
            $table->string('article_description')->nullable();
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
        Schema::dropIfExists('bon_livraison');
    }
};
