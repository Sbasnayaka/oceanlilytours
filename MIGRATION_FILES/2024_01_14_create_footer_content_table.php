<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('footer_content', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('section', 100);
            $table->string('label', 255);
            $table->text('value')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('section');
            $table->index('display_order');
            $table->index('active');
        });
    }

    public function down(): void {
        Schema::dropIfExists('footer_content');
    }
};
