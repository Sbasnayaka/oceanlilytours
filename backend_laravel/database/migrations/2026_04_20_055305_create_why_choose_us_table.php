<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('why_choose_us', function (Blueprint $table) {
            $table->id();
            $table->string('icon_class')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon_bg_color')->nullable();
            $table->string('icon_text_color')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('why_choose_us'); }
};
