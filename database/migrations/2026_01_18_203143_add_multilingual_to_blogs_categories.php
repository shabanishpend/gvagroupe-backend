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
        Schema::table('blogs_categories', function (Blueprint $table) {
            $table->string('title_fr')->nullable()->after('title');
            $table->string('title_en')->nullable()->after('title_fr');
            $table->string('title_de')->nullable()->after('title_en');
            $table->string('title_sq')->nullable()->after('title_de');
            $table->string('title_it')->nullable()->after('title_sq');
            $table->longText('description_fr')->nullable()->after('description');
            $table->longText('description_en')->nullable()->after('description_fr');
            $table->longText('description_de')->nullable()->after('description_en');
            $table->longText('description_sq')->nullable()->after('description_de');
            $table->longText('description_it')->nullable()->after('description_sq');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs_categories', function (Blueprint $table) {
            $table->dropColumn([
                'title_fr', 'title_en', 'title_de', 'title_sq', 'title_it',
                'description_fr', 'description_en', 'description_de', 'description_sq', 'description_it'
            ]);
        });
    }
};
