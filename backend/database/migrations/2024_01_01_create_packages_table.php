<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('image_url', 500)->nullable();
            $table->text('description')->nullable();
            $table->text('itinerary')->nullable();
            $table->integer('duration_days')->default(1);
            $table->integer('max_persons')->default(10);
            $table->boolean('featured')->default(false);
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes for performance
            $table->index('category_id');
            $table->index('featured');
            $table->index('active');
            $table->index('created_at');

            // Foreign key
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories_tour')
                  ->onDelete('set null');
        });
    }

    public function down(): void {
        Schema::dropIfExists('packages');
    }
};
