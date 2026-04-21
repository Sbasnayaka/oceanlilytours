<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('packages', function (Blueprint $table) {
            $table->string('sub_heading', 255)->nullable()->after('name');
            $table->string('tour_type', 100)->nullable()->after('duration_days');
            $table->string('location_count', 100)->nullable()->after('tour_type');
            $table->text('map_embed_code')->nullable()->after('image_url');
            $table->text('journey_highlights')->nullable()->after('itinerary');
            $table->text('insightful_tips')->nullable()->after('journey_highlights');
            $table->text('faq_content')->nullable()->after('insightful_tips');
            $table->string('seo_title', 255)->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords', 500)->nullable();
        });
    }

    public function down(): void {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn([
                'sub_heading', 'tour_type', 'location_count', 'map_embed_code', 
                'journey_highlights', 'insightful_tips', 'faq_content', 
                'seo_title', 'seo_description', 'seo_keywords'
            ]);
        });
    }
};
