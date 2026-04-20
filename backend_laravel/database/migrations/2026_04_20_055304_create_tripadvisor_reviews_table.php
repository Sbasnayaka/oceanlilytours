<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('tripadvisor_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('reviewer_name');
            $table->string('location')->nullable();
            $table->string('review_title')->nullable();
            $table->date('trip_date')->nullable();
            $table->integer('rating')->default(5);
            $table->text('review_text')->nullable();
            $table->string('reviewer_image')->nullable();
            $table->string('review_link', 500)->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('show_on_homepage')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('tripadvisor_reviews'); }
};
