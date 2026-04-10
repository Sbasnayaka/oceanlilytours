<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('about_us', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('content');
            $table->string('company_image', 500)->nullable();
            $table->string('mission', 500)->nullable();
            $table->string('vision', 500)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            // Only one row needed for about_us
            // Indexes
            $table->index('updated_at');
        });
    }

    public function down(): void {
        Schema::dropIfExists('about_us');
    }
};
