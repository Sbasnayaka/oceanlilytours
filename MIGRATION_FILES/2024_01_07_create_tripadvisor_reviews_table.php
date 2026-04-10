<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tripadvisor_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reviewer_name', 255);
            $table->text('review_text');
            $table->integer('rating')->default(5);
            $table->string('review_url', 500)->nullable();
            $table->string('reviewer_image', 500)->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('display_order');
            $table->index('active');
            $table->index('rating');
        });
    }

    public function down(): void {
        Schema::dropIfExists('tripadvisor_reviews');
    }
};
