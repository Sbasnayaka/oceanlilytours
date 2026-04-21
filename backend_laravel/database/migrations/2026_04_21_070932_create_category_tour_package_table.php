<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('category_tour_package', function (Blueprint $table) {
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('category_tour_id');

            $table->foreign('package_id')
                  ->references('id')->on('packages')
                  ->onDelete('cascade');
            $table->foreign('category_tour_id')
                  ->references('id')->on('categories_tour')
                  ->onDelete('cascade');
            
            $table->primary(['package_id', 'category_tour_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('category_tour_package');
    }
};
