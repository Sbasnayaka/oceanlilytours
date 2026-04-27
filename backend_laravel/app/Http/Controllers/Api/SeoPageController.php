<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SeoPage;

class SeoPageController extends Controller
{
    public function show($page_name)
    {
        $seo = SeoPage::where('page_name', $page_name)->first();
        
        if ($seo) {
            return response()->json($seo);
        }

        return response()->json(['message' => 'SEO settings not found for this page.'], 404);
    }
}
