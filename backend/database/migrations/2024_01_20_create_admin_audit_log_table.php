<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('admin_audit_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admin_user_id');
            $table->string('action', 100);
            $table->string('entity_type', 100);
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->string('entity_name', 255)->nullable();
            $table->text('old_values')->nullable();
            $table->text('new_values')->nullable();
            $table->string('ip_address', 50)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            // Indexes
            $table->index('admin_user_id');
            $table->index('action');
            $table->index('entity_type');
            $table->index('created_at');

            // Foreign key
            $table->foreign('admin_user_id')
                  ->references('id')
                  ->on('admin_users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('admin_audit_log');
    }
};
