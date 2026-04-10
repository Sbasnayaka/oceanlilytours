<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_name', 255);
            $table->string('client_title', 255)->nullable();
            $table->text('testimonial');
            $table->integer('rating')->default(5);
            $table->string('client_image', 500)->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('featured');
            $table->index('active');
            $table->index('rating');
        });
    }

    public function down(): void {
        Schema::dropIfExists('testimonials');
    }
};
