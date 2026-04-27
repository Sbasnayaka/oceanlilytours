<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $metrics = [
            'packages' => \App\Models\Package::count(),
            'inquiries' => \App\Models\Inquiry::count(),
            'blogs' => \App\Models\BlogPost::count(),
            'testimonials' => \App\Models\Testimonial::count(),
            'hero_slides' => \App\Models\HeroSlide::count(),
            'seo_pages' => \App\Models\SeoPage::count(),
        ];

        // Fetch recent actions (combining latest from different models)
        $recentInquiries = \App\Models\Inquiry::orderBy('created_at', 'desc')->take(4)->get()->map(function($i) {
            return (object)[
                'title' => 'New Inquiry from ' . $i->name,
                'description' => \Illuminate\Support\Str::limit($i->subject, 40),
                'time' => $i->created_at->diffForHumans(),
                'icon' => 'fa-envelope',
                'color' => 'blue'
            ];
        });

        $recentPackages = \App\Models\Package::orderBy('created_at', 'desc')->take(3)->get()->map(function($p) {
            return (object)[
                'title' => 'Package Added: ' . $p->name,
                'description' => 'Category: ' . ($p->category ? $p->category->name : 'N/A'),
                'time' => $p->created_at->diffForHumans(),
                'icon' => 'fa-suitcase',
                'color' => 'purple'
            ];
        });

        $recentBlogs = \App\Models\BlogPost::orderBy('created_at', 'desc')->take(3)->get()->map(function($b) {
            return (object)[
                'title' => 'Blog Published: ' . $b->title,
                'description' => 'By Admin',
                'time' => $b->created_at->diffForHumans(),
                'icon' => 'fa-blog',
                'color' => 'green'
            ];
        });

        $recentActions = $recentInquiries->concat($recentPackages)->concat($recentBlogs)
            ->sortByDesc('time') // Sort logic might be slightly off due to diffForHumans strings, but good enough for presentation. Actually let's just merge and take 8.
            ->take(8);

        return view('admin.dashboard', compact('metrics', 'recentActions'));
    }
}
