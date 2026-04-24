<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            if (!Schema::hasColumn('hero_slides', 'badge_text')) {
                $table->string('badge_text', 100)->nullable()->after('title');
            }
            if (!Schema::hasColumn('hero_slides', 'cta_primary_text')) {
                $table->string('cta_primary_text', 100)->nullable()->after('button_url');
            }
            if (!Schema::hasColumn('hero_slides', 'cta_secondary_text')) {
                $table->string('cta_secondary_text', 100)->nullable()->after('cta_primary_text');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn(['badge_text', 'cta_primary_text', 'cta_secondary_text']);
        });
    }
};
