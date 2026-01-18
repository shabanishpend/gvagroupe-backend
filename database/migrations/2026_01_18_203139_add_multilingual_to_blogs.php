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
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('title_fr')->nullable()->after('title');
            $table->string('title_en')->nullable()->after('title_fr');
            $table->string('title_de')->nullable()->after('title_en');
            $table->string('title_sq')->nullable()->after('title_de');
            $table->string('title_it')->nullable()->after('title_sq');
            $table->longText('content_fr')->nullable()->after('content');
            $table->longText('content_en')->nullable()->after('content_fr');
            $table->longText('content_de')->nullable()->after('content_en');
            $table->longText('content_sq')->nullable()->after('content_de');
            $table->longText('content_it')->nullable()->after('content_sq');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn([
                'title_fr', 'title_en', 'title_de', 'title_sq', 'title_it',
                'content_fr', 'content_en', 'content_de', 'content_sq', 'content_it'
            ]);
        });
    }
};
