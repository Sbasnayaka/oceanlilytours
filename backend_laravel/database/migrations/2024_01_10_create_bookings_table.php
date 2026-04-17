<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('booking_reference', 50)->unique();
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('inquiry_id')->nullable();
            $table->string('customer_name', 255);
            $table->string('customer_email', 255);
            $table->string('customer_phone', 50);
            $table->integer('number_of_persons');
            $table->date('travel_date');
            $table->decimal('total_price', 12, 2);
            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->string('status', 50)->default('pending');
            $table->text('special_requests')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->unsignedBigInteger('confirmed_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('package_id');
            $table->index('inquiry_id');
            $table->index('status');
            $table->index('travel_date');
            $table->index('created_at');

            // Foreign keys
            $table->foreign('package_id')
                  ->references('id')
                  ->on('packages')
                  ->onDelete('restrict');
        });
    }

    public function down(): void {
        Schema::dropIfExists('bookings');
    }
};
