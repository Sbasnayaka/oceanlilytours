<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('setting_key', 100)->unique();
            $table->text('setting_value')->nullable();
            $table->string('category', 50)->default('general');
            $table->string('type', 50)->default('string');
            $table->boolean('public')->default(false);
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            // Indexes
            $table->index('category');
            $table->index('setting_key');
        });
    }

    public function down(): void {
        Schema::dropIfExists('settings');
    }
};
