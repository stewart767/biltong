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
        // Handle logo & image file uploads
        $imageFields = [
            'site_logo',
            'site_favicon',
            'hero_slide_1_image',
            'hero_slide_2_image',
            'hero_slide_3_image',
            'hero_slide_4_image',
            'sidebar_promo_image',
            'social_img_1',
            'social_img_2',
            'social_img_3',
            'social_img_4',
        ];

        if ($request->boolean('remove_logo')) {
            SiteSetting::set('site_logo', null);
        }

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                if ($field === 'site_logo' || $field === 'site_favicon') {
                    $destination = public_path('images/logos');
                    $subDir = 'images/logos/';
                } elseif (str_starts_with($field, 'social_img_')) {
                    $destination = public_path('images/social');
                    $subDir = 'images/social/';
                } else {
                    $destination = public_path('images/hero');
                    $subDir = 'images/hero/';
                }

                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }

                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $file->move($destination, $filename);
                
                $path = $subDir . $filename;

                SiteSetting::set($field, $path);
            }
        }

        $data = $request->except(array_merge(['_token', 'remove_logo'], $imageFields));

        foreach ($data as $key => $val) {
            SiteSetting::set($key, $val);
        }

        return back()->with('success', 'Logo, branding assets and store configuration saved successfully.');
    }
}
