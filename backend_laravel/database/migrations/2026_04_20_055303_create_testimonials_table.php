<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->integer('rating')->default(5);
            $table->text('review_text');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->string('profile_image')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('verified')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('testimonials'); }
};
