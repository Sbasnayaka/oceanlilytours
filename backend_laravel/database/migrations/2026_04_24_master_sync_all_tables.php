<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Hero Slides
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

        // 2. Packages
        Schema::table('packages', function (Blueprint $table) {
            if (!Schema::hasColumn('packages', 'sub_heading')) {
                $table->string('sub_heading', 255)->nullable()->after('name');
            }
            if (!Schema::hasColumn('packages', 'tour_type')) {
                $table->string('tour_type', 100)->nullable();
            }
            if (!Schema::hasColumn('packages', 'location_count')) {
                $table->string('location_count', 100)->nullable();
            }
            if (!Schema::hasColumn('packages', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('active');
            }
        });

        // 3. Blog Posts
        Schema::table('blog_posts', function (Blueprint $table) {
            if (!Schema::hasColumn('blog_posts', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('active');
            }
        });

        // 4. Navbar Items (ensure active and order exist)
        if (Schema::hasTable('navbar_items')) {
            Schema::table('navbar_items', function (Blueprint $table) {
                if (!Schema::hasColumn('navbar_items', 'active')) {
                    $table->boolean('active')->default(true);
                }
                if (!Schema::hasColumn('navbar_items', 'display_order')) {
                    $table->integer('display_order')->default(0);
                }
            });
        }

        // 5. Footer Content
        if (Schema::hasTable('footer_contents')) {
            Schema::table('footer_contents', function (Blueprint $table) {
                if (!Schema::hasColumn('footer_contents', 'active')) {
                    $table->boolean('active')->default(true);
                }
                if (!Schema::hasColumn('footer_contents', 'display_order')) {
                    $table->integer('display_order')->default(0);
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reverse needed as these are safety syncs
    }
};
