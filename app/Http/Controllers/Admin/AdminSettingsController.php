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
        $data = $request->except('_token');

        foreach ($data as $key => $val) {
            SiteSetting::set($key, $val);
        }

        return back()->with('success', 'Website settings, business information and headlines saved successfully.');
    }
}
