<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('footer_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section')->nullable();
            $table->string('key_name')->nullable();
            $table->text('value')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('footer_contents'); }
};
