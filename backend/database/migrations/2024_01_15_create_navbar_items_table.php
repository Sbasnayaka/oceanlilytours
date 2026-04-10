<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('navbar_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label', 255);
            $table->string('url', 500);
            $table->string('target', 20)->default('_self');
            $table->integer('display_order')->default(0);
            $table->boolean('active')->default(true);
            $table->boolean('show_in_menu')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('display_order');
            $table->index('active');
            $table->index('show_in_menu');
        });
    }

    public function down(): void {
        Schema::dropIfExists('navbar_items');
    }
};
