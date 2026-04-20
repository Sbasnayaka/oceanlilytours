<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'adventure' => 'Adventure',
            'wildlife' => 'Wildlife',
            'lifestyle' => 'Lifestyle',
        ];

        $categoryIds = [];
        foreach ($categories as $slug => $name) {
            $categoryIds[$slug] = DB::table('categories_blog')->insertGetId([
                'name' => $name,
                'slug' => $slug,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('blog_posts')->insert([
            [
                'title' => "The Misty Allure of Ella: A Hiker's Paradise",
                'slug' => 'misty-allure-ella-hiking',
                'category_id' => $categoryIds['adventure'],
                'content' => "The misty mountains of Ella hold secrets that few travelers get to experience. With elevations over 1,000 meters and lush tea plantations surrounding the town, Ella offers an escape that feels truly remote yet surprisingly accessible. This guide will take you through the best hiking trails.",
                'excerpt' => "Discover why this tiny mountain town is stealing hearts and how to find the secret waterfalls...",
                'featured_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAxBCqQrY0u-FDpYRRR0Mb7qC7yL0NHciQOCaGpIkk1u2UnO0OrcfvWOkXki9LTGJ7hPuFWT30zCbfjpQ4AkYcbpgByUBjV0Kx8qTwpfts31AyQaucK04yj_k6HHwjV-B_G9a1Fo2oK7I30b6UOHzuqr7a8V17Do1FXzw0kLR0DoFRJtyn2VF2CqWDQykJi9fq96USX-o4mBcYM6f5MPTV_V2PIW6k0Jp1Pa1pmfsRaPOdEWvocLQsHIB8CwFYn_r7PwILU-6d_0jhI',
                'featured' => true,
                'published' => true,
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => "Ethical Safaris: Respecting the Giants",
                'slug' => 'ethical-safaris-wildlife-respect',
                'category_id' => $categoryIds['wildlife'],
                'content' => "Wildlife safari experiences in Sri Lanka are breathtaking, but they come with responsibility. Our approach to ethical tourism ensures that animals are treated with respect and their natural habitats are protected.",
                'excerpt' => "Learn about our commitment to wildlife preservation and the best times for elephant sightings...",
                'featured_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBF9eqtV7HoEBNLm1fkT9jQYUlGlWiVqzIpAnbi2QJBYMbc0HjAOshw8nChfKMssL2RiEc605E0XuDBpDKLOJAAbtu9gqFZ60Gqv_Yf2HEEkr8ZsEdM6hyEIwyHKatwDToJEq9PS8pVtok0KXEylXA2QldfkGunwmdc-U70SN5gKmCtbaxcEs3zU80qe3Ce9AJpA-1DVJ2AgIN455WeOhaFaLiwIPpIlwe0m2UnBIAortQlWkxSeLag0vlQlUIaU7jLiuigIu7K688i',
                'featured' => true,
                'published' => true,
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => "Coastal Calm: The South's Best Secret Bays",
                'slug' => 'coastal-calm-secret-beaches-south',
                'category_id' => $categoryIds['lifestyle'],
                'content' => "While many tourists flock to the popular beaches on Sri Lanka's south coast, there exist hidden gems that offer the ultimate beach experience away from the crowds.",
                'excerpt' => "Skip the crowds and find the pristine, quiet bays where time slows down to the pace of the tides...",
                'featured_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAPtIzV3xMjwx-5MxB0k1m1CgTsCJz7A0IVhd6Nb4XUEipIuujFV7PeT2pXMPWF9l9H-t01zhzDXPG1P3Ija0E9Q3bLjK1zp5YuemUHQCsWecpwNzpsHDXPbVShKiNKFY-evQz1Rz_EBIZ59YtKUku7WBh15Ska_yWVhfsIqLom9eciyhGf_OFYwKioNBBX5FkOWyBKwdC6_3uPm9CatcvWL1P0HEi0gpeA5z389y_10pyf0JnHQUa1nKo5HaXpBddABM-VMQXFBGga',
                'featured' => true,
                'published' => true,
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
