<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('phone', 50)->nullable();
            $table->string('subject', 255);
            $table->text('message');
            $table->string('status', 50)->default('new');
            $table->text('admin_notes')->nullable();
            $table->timestamp('contacted_at')->nullable();
            $table->unsignedBigInteger('contacted_by')->nullable();
            $table->boolean('is_spam')->default(false);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('status');
            $table->index('email');
            $table->index('created_at');
            $table->index('is_spam');
        });
    }

    public function down(): void {
        Schema::dropIfExists('inquiries');
    }
};
