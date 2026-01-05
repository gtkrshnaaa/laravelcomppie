<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Show company settings form
     */
    public function index()
    {
        $setting = CompanySetting::getSetting();
        
        if (!$setting) {
            $setting = new CompanySetting();
        }

        return view('admin.settings.company.index', compact('setting'));
    }

    /**
     * Update company settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'company_description' => 'nullable|string',
            'about_us' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'phone_secondary' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'business_hours' => 'nullable|array',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'google_analytics_id' => 'nullable|string|max:50',
        ]);

        // Handle logo upload
        if ($request->hasFile('company_logo')) {
            $setting = CompanySetting::getSetting();
            
            // Delete old logo if exists
            if ($setting && $setting->company_logo && Storage::disk('public')->exists($setting->company_logo)) {
                Storage::disk('public')->delete($setting->company_logo);
            }

            $logoPath = $request->file('company_logo')->store('company', 'public');
            $validated['company_logo'] = $logoPath;
        }

        CompanySetting::updateSettings($validated);

        return redirect()->route('admin.settings.company.index')
            ->with('success', 'Company settings updated successfully.');
    }
}
