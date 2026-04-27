<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $recentInquiries = \App\Models\Inquiry::orderBy('created_at', 'desc')->take(5)->get();
        return view('admin.dashboard', compact('recentInquiries'));
    }
}
