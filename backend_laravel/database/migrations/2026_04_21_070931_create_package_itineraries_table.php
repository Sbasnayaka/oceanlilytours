<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('package_itineraries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('package_id');
            $table->integer('day_number');
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('image_url', 500)->nullable();
            $table->timestamps();

            $table->foreign('package_id')
                  ->references('id')->on('packages')
                  ->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('package_itineraries');
    }
};
