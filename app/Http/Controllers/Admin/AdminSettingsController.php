<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminSettingsController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::pluck('value', 'key')->all();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        // Handle file uploads for brand logo, hero carousel & promo images
        if ($request->boolean('remove_site_logo')) {
            SiteSetting::set('site_logo', '');
        }

        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $filename = 'logo_' . time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $file->move(public_path('images/brand'), $filename);
            SiteSetting::set('site_logo', 'images/brand/' . $filename);
        }

        $imageFields = [
            'hero_slide_1_image',
            'hero_slide_2_image',
            'hero_slide_3_image',
            'hero_slide_4_image',
            'sidebar_promo_image',
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $file->move(public_path('images/hero'), $filename);
                SiteSetting::set($field, 'images/hero/' . $filename);
            }
        }

        $data = $request->except(array_merge(['_token', 'site_logo', 'remove_site_logo'], $imageFields));

        foreach ($data as $key => $val) {
            SiteSetting::set($key, $val);
        }

        return back()->with('success', 'Website settings, hero carousel images and promotional content saved successfully.');
    }
}
