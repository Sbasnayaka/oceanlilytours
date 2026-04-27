<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlide;
use App\Models\NavbarItem;
use App\Models\FooterContent;
use App\Models\WhyChooseUs;
use App\Models\AboutUs;
use App\Models\Setting;

class FrontendDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Hero Slides
        $heroSlides = [
            [
                'title' => 'Ethereal Luxury in Sri Lanka.',
                'badge_text' => 'Discover The Pearl of Asia',
                'description' => 'Immerse yourself in a sanctuary where the Indian Ocean meets curated wellness and ancient heritage. Experience the island like never before.',
                'image_url' => 'assets/uploads/hero-slider-p01.png',
                'cta_primary_text' => 'Start Your Journey',
                'cta_secondary_text' => 'Watch Experience',
                'display_order' => 1,
                'active' => true,
            ],
            [
                'title' => 'Ethereal Luxury in Sri Lanka.',
                'badge_text' => 'Discover The Pearl of Asia',
                'description' => 'Immerse yourself in a sanctuary where the Indian Ocean meets curated wellness and ancient heritage. Experience the island like never before.',
                'image_url' => 'assets/uploads/hero-slider-p02.png',
                'cta_primary_text' => 'Start Your Journey',
                'cta_secondary_text' => 'Watch Experience',
                'display_order' => 2,
                'active' => true,
            ],
            [
                'title' => 'Ethereal Luxury in Sri Lanka.',
                'badge_text' => 'Discover The Pearl of Asia',
                'description' => 'Immerse yourself in a sanctuary where the Indian Ocean meets curated wellness and ancient heritage. Experience the island like never before.',
                'image_url' => 'assets/uploads/hero-slider-p03.png',
                'cta_primary_text' => 'Start Your Journey',
                'cta_secondary_text' => 'Watch Experience',
                'display_order' => 3,
                'active' => true,
            ]
        ];

        foreach ($heroSlides as $slide) {
            try {
                HeroSlide::firstOrCreate(['title' => $slide['title']], $slide);
            } catch (\Exception $e) {
                // Skip on duplicate
            }
        }

        // 2. Navbar Items
        $navbarItems = [
            ['label' => 'Home', 'url' => '#home', 'display_order' => 1],
            ['label' => 'Packages', 'url' => 'pages/packages.html', 'display_order' => 2],
            ['label' => 'Blog', 'url' => 'pages/blog.html', 'display_order' => 3],
            ['label' => 'Gallery', 'url' => 'pages/gallery.html', 'display_order' => 4],
            ['label' => 'Contact', 'url' => 'pages/contact.html', 'display_order' => 5],
            ['label' => 'About Us', 'url' => '#about', 'display_order' => 6],
        ];

        foreach ($navbarItems as $item) {
            try {
                NavbarItem::firstOrCreate(['label' => $item['label']], $item);
            } catch (\Exception $e) {
                // Skip
            }
        }

        // 3. Footer Content
        $footerContent = [
            ['section' => 'Quick Links', 'key_name' => 'Destinations', 'value' => '#', 'display_order' => 1],
            ['section' => 'Quick Links', 'key_name' => 'Packages', 'value' => 'pages/packages.html', 'display_order' => 2],
            ['section' => 'Quick Links', 'key_name' => 'Wellness Retreats', 'value' => '#', 'display_order' => 3],
            ['section' => 'Quick Links', 'key_name' => 'Sustainable Travel', 'value' => '#', 'display_order' => 4],
            
            ['section' => 'Legal', 'key_name' => 'Privacy Policy', 'value' => '#', 'display_order' => 1],
            ['section' => 'Legal', 'key_name' => 'Terms & Conditions', 'value' => '#', 'display_order' => 2],
            ['section' => 'Legal', 'key_name' => 'Contact Us', 'value' => 'pages/contact.html', 'display_order' => 3],
            
            ['section' => 'Contact Info', 'key_name' => 'Email', 'value' => 'hello@oceanlilytours.com', 'display_order' => 1],
            ['section' => 'Contact Info', 'key_name' => 'Phone', 'value' => '+94 77 123 4567', 'display_order' => 2],
            ['section' => 'Contact Info', 'key_name' => 'Location', 'value' => 'Colombo, Sri Lanka', 'display_order' => 3],
        ];

        foreach ($footerContent as $content) {
            try {
                FooterContent::firstOrCreate(['key_name' => $content['key_name']], $content);
            } catch (\Exception $e) {
                // Skip
            }
        }

        // 4. Why Choose Us (Features)
        $features = [
            [
                'title' => 'Expert Local Guidance',
                'description' => 'Certified guides with deep roots in local traditions and hidden gems.',
                'icon_class' => 'verified_user',
                'icon_bg_color' => '#EFF6FF',
                'icon_text_color' => '#1d4ed8',
                'display_order' => 1,
            ],
            [
                'title' => 'Sustainable Travel',
                'description' => "Eco-conscious itineraries that preserve our island's natural heritage.",
                'icon_class' => 'eco',
                'icon_bg_color' => '#F0FDF4',
                'icon_text_color' => '#15803d',
                'display_order' => 2,
            ]
        ];

        foreach ($features as $feature) {
            try {
                WhyChooseUs::firstOrCreate(['title' => $feature['title']], $feature);
            } catch (\Exception $e) {
                // Skip
            }
        }

        // 5. About Us
        try {
            if (!AboutUs::first()) {
                AboutUs::create([
                    'title' => 'Crafting Unforgettable Coastal Memories.',
                    'description' => "At Ocean Lilly Tours, we believe travel is more than just a destination—it's a spiritual awakening. Founded on the principles of luxury nature and lotus elegance, we curate bespoke journeys that honor Sri Lanka's raw beauty while providing modern sanctuary.",
                    'mission_text' => 'To showcase the authentic soul of Sri Lanka through sustainable, ultra-luxury experiences.',
                    'vision_text' => 'To be the world’s most trusted boutique travel curator for the discerning explorer.',
                    'values_text' => 'Authenticity, Sustainability, Lotus Elegance, Personalized Care.',
                    'team_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDhlO4O2CzcK3zeOjm0qV7bD_xWrZLF1PIb1fs6N_dkYLuRBu0VD4bNe5C2SXL1hZcntMHonEZHuPltAwSxVo-7SoBGXpqpZ8Ob9uN4UVQgJeuSc97EODgXIOm9oyduhJIYI8RFsT6x2spBNUlXxGaBcQKxCdhd_ShmpXybIsLwVKN7b9ft7DNVxvD1zkXoT4IxzuHO4PSaY7i7HgNvO23v-pNY75sE8waTWewK5ts3boi9UqiTEn1tEDiCcXovbmcFNkzOUR8naL8l',
                ]);
            }
        } catch (\Exception $e) {
            // Skip
        }

        // 6. Default Settings
        $settings = [
            ['key_name' => 'site_name', 'value' => 'Ocean Lilly Tours', 'category' => 'General'],
            ['key_name' => 'contact_email', 'value' => 'hello@oceanlilytours.com', 'category' => 'Contact'],
            ['key_name' => 'contact_phone', 'value' => '+94 77 123 4567', 'category' => 'Contact'],
            ['key_name' => 'address', 'value' => 'Colombo, Sri Lanka', 'category' => 'Contact'],
            ['key_name' => 'facebook_url', 'value' => '#', 'category' => 'Social'],
            ['key_name' => 'instagram_url', 'value' => '#', 'category' => 'Social'],
            ['key_name' => 'whatsapp_number', 'value' => '+94771234567', 'category' => 'Social'],
        ];

        foreach ($settings as $setting) {
            try {
                Setting::firstOrCreate(['key_name' => $setting['key_name']], $setting);
            } catch (\Exception $e) {
                // Skip
            }
        }
    }
}
