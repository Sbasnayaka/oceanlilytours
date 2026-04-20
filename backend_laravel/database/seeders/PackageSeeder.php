<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    public function run()
    {
        // 1. Create the Categories first to prevent Foreign Key errors
        $categories = [
            'nature-wellness' => 'Nature & Wellness',
            'romantic-luxury' => 'Romantic Luxury',
            'cultural-heritage' => 'Cultural Heritage',
            'adventure-combo' => 'Adventure Combo',
            'spa-wellness' => 'Spa & Wellness',
            'tea-country' => 'Tea Country Tour',
            'cultural-deep-dive' => 'Cultural Deep Dive',
            'premium-luxury' => 'Premium Luxury',
        ];

        $categoryIds = [];
        foreach ($categories as $slug => $name) {
            $categoryIds[$slug] = DB::table('categories_tour')->insertGetId([
                'name' => $name,
                'slug' => $slug,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Shared Image URLs from the frontend 
        $img1 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuDhlO4O2CzcK3zeOjm0qV7bD_xWrZLF1PIb1fs6N_dkYLuRBu0VD4bNe5C2SXL1hZcntMHonEZHuPltAwSxVo-7SoBGXpqpZ8Ob9uN4UVQgJeuSc97EODgXIOm9oyduhJIYI8RFsT6x2spBNUlXxGaBcQKxCdhd_ShmpXybIsLwVKN7b9ft7DNVxvD1zkXoT4IxzuHO4PSaY7i7HgNvO23v-pNY75sE8waTWewK5ts3boi9UqiTEn1tEDiCcXovbmcFNkzOUR8naL8l';
        $img2 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuB3yagudF0FqYqs0oGGZ8gcTWTfg8-NDG5DK5BWFCCoHTmGQ72cmn00LWiVXtJdZUX5AgYX0iqDlof_yecMUV_jvkdi5JROityNnKfSOeE6qLPAKXhPMF2TqAjBsKh0H6EZelwr6IWNYGcvcuvwhQlpOD-sGzS3MIuMqjcWMu64WTqnx7mGEtT7irms6eQZKBsIqydMFzQ1b-olfZZiRSzJ6C9jP_S8MJ1x_ogCkSXPyVwI2pk2c8GzQWRbTHd5_zblAeCZTsYav-8h';
        $img4 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuCcz2wkc5xGo62bhWNGoEnEn2zcJppcmSYyIIeos-oAASCUKOEULEwcmo61SaRbmRQgo2rA0MmvHNSXJRzDoOBvwVBRZSMmIAc9ythKGSK4tGux39i2qHkHpX_g1okd6D5PlJYZVPZNPcsvAgUOCUv7qlhz7u2WNAkoyvK-K3vlWR9toXHrME-BmdRfB4GxvYlR2HmocAHJlLF6c5xaNvgyAcjPjRIIbTOU-ibk7xgHkuEWHFp8sy2_19C16H5H9GdXQwWAiDVYyqPs';
        $img5 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuBcp_8obXOqh8mvZqZXS17e_qjSPWWhUrTpjwCuMDFsqf5IGhF0p5s9c25IzWyOmDZXHxDF_FCAtKgSDd84v96AHdWuA7-q85lUwHrZJyS1k1yHKFjXF5i5SnpKBZ8QDGa0BU_gtlzXO83q3kQORqR8hNqRF2BTcsplpVx-D5de4KIxHD7Q24wX9452xA7vSqNUiWSgMJJNJz03c8gNWBWEc7CH9HXYS6_KpHemsB_tRLeRGxn6YT6hot6YuzzgPHriKb1FuAc1aGUW';

        // 2. Insert Packages mapping to the exact HTML required shapes
        DB::table('packages')->insert([
            [
                'name' => '7 Day Nature Explorer',
                'slug' => 'nature-explorer',
                'price' => 1250,
                'category_id' => $categoryIds['nature-wellness'],
                'image_url' => $img1,
                'description' => "Discover the misty hills of Ella, the ancient temples of Kandy, and the lush wildlife of Yala.",
                'itinerary' => json_encode([]),
                'duration_days' => 7,
                'max_persons' => 10,
                'featured' => true,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Honeymoon Escape',
                'slug' => 'honeymoon-escape',
                'price' => 2100,
                'category_id' => $categoryIds['romantic-luxury'],
                'image_url' => $img2,
                'description' => "A private, candle-lit journey through Sri Lanka's most romantic boutique stays and golden beaches.",
                'itinerary' => json_encode([]),
                'duration_days' => 7,
                'max_persons' => 2,
                'featured' => true,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '3 Day Highlights',
                'slug' => '3-day-highlights',
                'price' => 650,
                'category_id' => $categoryIds['cultural-heritage'],
                'image_url' => $img2,
                'description' => "Perfect for those short on time but wanting to see the historic heart of the island.",
                'itinerary' => json_encode([]),
                'duration_days' => 3,
                'max_persons' => 15,
                'featured' => false,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '5 Day Island Paradise',
                'slug' => 'island-paradise',
                'price' => 950,
                'category_id' => $categoryIds['adventure-combo'],
                'image_url' => $img4,
                'description' => "Pristine beaches, coral reefs, and sunset sailing on the Indian Ocean.",
                'itinerary' => json_encode([]),
                'duration_days' => 5,
                'max_persons' => 8,
                'featured' => false,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ayurveda Healing Retreat',
                'slug' => 'ayurveda-retreat',
                'price' => 1800,
                'category_id' => $categoryIds['spa-wellness'],
                'image_url' => $img5,
                'description' => "Traditional Ayurvedic treatments, yoga sessions, and health restoration.",
                'itinerary' => json_encode([]),
                'duration_days' => 7,
                'max_persons' => 4,
                'featured' => false,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Central Highlands Explorer',
                'slug' => 'highlands-explorer',
                'price' => 1100,
                'category_id' => $categoryIds['tea-country'],
                'image_url' => $img2,
                'description' => "Tea plantations, mountain trains, waterfalls, and cool climate villages.",
                'itinerary' => json_encode([]),
                'duration_days' => 5,
                'max_persons' => 10,
                'featured' => false,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ancient Kingdoms Tour',
                'slug' => 'ancient-kingdoms',
                'price' => 1350,
                'category_id' => $categoryIds['cultural-deep-dive'],
                'image_url' => $img5,
                'description' => "Sacred temples, ancient ruins, palace complexes, and cultural sites.",
                'itinerary' => json_encode([]),
                'duration_days' => 5,
                'max_persons' => 12,
                'featured' => false,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'All-Inclusive Grand Tour',
                'slug' => 'grand-tour',
                'price' => 3200,
                'category_id' => $categoryIds['premium-luxury'],
                'image_url' => $img2,
                'description' => "14 days experiencing everything: beaches, mountains, wildlife, and luxury stays.",
                'itinerary' => json_encode([]),
                'duration_days' => 14,
                'max_persons' => 6,
                'featured' => true,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
