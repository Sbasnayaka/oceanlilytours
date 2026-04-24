<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->string('badge_text', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('image_url', 500);
            $table->string('button_text', 100)->nullable();
            $table->string('button_url', 500)->nullable();
            $table->string('cta_primary_text', 100)->nullable();
            $table->string('cta_secondary_text', 100)->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('display_order');
            $table->index('active');
            $table->unique(['display_order', 'active']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('hero_slides');
    }
};
