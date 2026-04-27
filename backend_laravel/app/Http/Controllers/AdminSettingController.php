<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key_name');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $updates = $request->input('settings', []);
        
        // Handle boolean checkboxes that might not be in the request if unchecked
        if (!isset($updates['maintenance_mode'])) {
            $updates['maintenance_mode'] = '0';
        } else {
            $updates['maintenance_mode'] = '1';
        }

        // Handle regular text/textarea updates
        foreach ($updates as $key => $value) {
            Setting::where('key_name', $key)->update(['value' => $value]);
        }

        // Handle File Uploads
        $fileKeys = ['site_logo', 'site_favicon', 'maintenance_bg'];
        foreach ($fileKeys as $key) {
            if ($request->hasFile("files.$key")) {
                $file = $request->file("files.$key");
                $filename = time() . '_' . $key . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/settings'), $filename);
                
                $setting = Setting::where('key_name', $key)->first();
                if ($setting) {
                    if ($setting->value && File::exists(public_path($setting->value))) {
                        File::delete(public_path($setting->value));
                    }
                    $setting->update(['value' => '/uploads/settings/' . $filename]);
                }
            }
        }

        return redirect()->route('settings.index')->with('success', 'System settings updated successfully.');
    }

    public function clearCache()
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            return redirect()->route('settings.index')->with('success', 'System cache cleared successfully!');
        } catch (\Exception $e) {
            return redirect()->route('settings.index')->withErrors(['error' => 'Failed to clear cache: ' . $e->getMessage()]);
        }
    }
}
