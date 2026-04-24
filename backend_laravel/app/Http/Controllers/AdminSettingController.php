<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('category');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $updates = $request->input('settings', []);
        
        foreach ($updates as $key => $value) {
            Setting::where('key_name', $key)->update(['value' => $value]);
        }

        return redirect()->route('settings.index')->with('success', 'System settings updated successfully.');
    }
}
