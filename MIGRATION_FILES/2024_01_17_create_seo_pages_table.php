<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('seo_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_name', 100)->unique();
            $table->string('page_url', 500);
            $table->string('meta_title', 255);
            $table->text('meta_description');
            $table->text('meta_keywords')->nullable();
            $table->string('og_image', 500)->nullable();
            $table->string('og_title', 255)->nullable();
            $table->text('og_description')->nullable();
            $table->boolean('index_enabled')->default(true);
            $table->boolean('follow_enabled')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('page_name');
            $table->index('index_enabled');
        });
    }

    public function down(): void {
        Schema::dropIfExists('seo_pages');
    }
};
