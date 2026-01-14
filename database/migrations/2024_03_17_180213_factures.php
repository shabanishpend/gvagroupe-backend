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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('company_to_name')->nullable();;
            $table->string('company_to_address')->nullable();
            $table->string('company_to_postal_code')->nullable();
            $table->string('company_to_city_date')->nullable();
            $table->string('nr_plaque')->nullable();
            $table->string('km_voiture')->nullable();
            $table->string('pu_kw')->nullable();
            $table->string('annee')->nullable();
            $table->string('marque')->nullable();
            $table->string('type')->nullable();
            $table->string('chassis')->nullable();
            $table->string('hml')->nullable();
            $table->string('intervenation_date')->nullable();
            $table->string('tvsh')->nullable();
            $table->string('total_tva')->nullable();
            $table->string('total_ttc')->nullable();
            $table->string('total_hors_quantity')->nullable();
            $table->string('total_hors_tva')->nullable();
            $table->string('total_hors_price')->nullable();
            $table->string('name')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
