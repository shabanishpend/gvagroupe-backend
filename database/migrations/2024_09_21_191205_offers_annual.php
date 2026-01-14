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
        Schema::create('offers_annual', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('website')->nullable();
            $table->smallInteger('cars_number')->nullable();
            $table->string('price')->nullable();
            $table->string('price_discount')->nullable();
            $table->string('total_price')->nullable();
            $table->text('conditions')->nullable();
            $table->text('signature_footer')->nullable();
            $table->text('footer_text')->nullable();
            $table->text('services')->nullable()->collation('utf8mb4_unicode_ci');
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
        Schema::dropIfExists('offers_annual');
    }
};
