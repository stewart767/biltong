<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminContentController extends Controller
{
    public function banners(): View
    {
        $banners = Banner::orderBy('type')->orderBy('sort_order')->get();
        $heroSlides = Banner::where('type', 'hero')->orderBy('sort_order')->get();
        $comboBanners = Banner::where('type', 'combo_pack')->orderBy('sort_order')->get();
        $promoBanners = Banner::whereNotIn('type', ['hero', 'combo_pack'])->orderBy('sort_order')->get();

        return view('admin.content.banners', compact('banners', 'heroSlides', 'comboBanners', 'promoBanners'));
    }

    public function storeBanner(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'subtitle' => 'nullable|string|max:500',
            'badge' => 'nullable|string|max:100',
            'image_url' => 'nullable|string',
            'cta_text' => 'nullable|string|max:50',
            'cta_url' => 'nullable|string|max:255',
            'secondary_cta_text' => 'nullable|string|max:50',
            'secondary_cta_url' => 'nullable|string|max:255',
            'type' => 'required|in:hero,promo,combo_pack,lifestyle',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $destination = public_path('images/banners');
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $validated['image_url'] = 'images/banners/' . $filename;
        }

        $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : true;
        $validated['sort_order'] = (int) ($request->input('sort_order', 0) ?? 0);

        Banner::create($validated);
        return back()->with('success', 'Slide / Banner created successfully.');
    }

    public function updateBanner(Request $request, Banner $banner): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'subtitle' => 'nullable|string|max:500',
            'badge' => 'nullable|string|max:100',
            'image_url' => 'nullable|string',
            'cta_text' => 'nullable|string|max:50',
            'cta_url' => 'nullable|string|max:255',
            'secondary_cta_text' => 'nullable|string|max:50',
            'secondary_cta_url' => 'nullable|string|max:255',
            'type' => 'required|in:hero,promo,combo_pack,lifestyle',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $destination = public_path('images/banners');
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $validated['image_url'] = 'images/banners/' . $filename;
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = (int) ($request->input('sort_order', 0) ?? 0);

        $banner->update($validated);

        return back()->with('success', 'Slide / Banner updated successfully.');
    }

    public function destroyBanner(Banner $banner): RedirectResponse
    {
        $banner->delete();
        return back()->with('success', 'Banner deleted.');
    }

    public function testimonials(): View
    {
        $testimonials = Testimonial::orderBy('sort_order')->get();
        return view('admin.content.testimonials', compact('testimonials'));
    }

    public function storeTestimonial(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_role' => 'nullable|string|max:150',
            'location' => 'required|string|max:100',
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        Testimonial::create($validated);
        return back()->with('success', 'Customer testimonial added.');
    }

    public function updateTestimonial(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_role' => 'nullable|string|max:150',
            'location' => 'required|string|max:100',
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $testimonial->update($validated);

        return back()->with('success', 'Testimonial updated.');
    }

    public function destroyTestimonial(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();
        return back()->with('success', 'Testimonial deleted.');
    }
}
