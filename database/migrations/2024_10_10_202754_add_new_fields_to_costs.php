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
        Schema::table('costs', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('mode_payment')->nullable();
            $table->string('observations')->nullable();
            $table->unsignedBigInteger('sub_catgory_id')->nullable();
            $table->foreign('sub_catgory_id')
            ->references('id')
            ->on('cost_sub_categories')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('costs', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('description');
            $table->dropColumn('mode_payment');
            $table->dropColumn('observations');
            $table->dropColumn('sub_catgory_id');
        });
    }
};
