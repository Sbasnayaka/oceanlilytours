<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('content');
            $table->text('excerpt')->nullable();
            $table->string('featured_image', 500)->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('published')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('category_id');
            $table->index('featured');
            $table->index('published');
            $table->index('published_at');
            $table->fullText(['title', 'content']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('blog_posts');
    }
};
