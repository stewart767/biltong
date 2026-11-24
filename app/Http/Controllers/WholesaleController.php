<?php

namespace App\Http\Controllers;

use App\Models\WholesaleEnquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WholesaleController extends Controller
{
    public function index(): View
    {
        return view('pages.wholesale');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:150',
            'contact_person' => 'required|string|max:150',
            'phone' => 'required|string|max:40',
            'email' => 'required|email|max:150',
            'business_type' => 'required|string|max:100',
            'estimated_quantity' => 'required|string|max:100',
            'delivery_location' => 'required|string|max:150',
            'message' => 'required|string|max:2000',
        ]);

        WholesaleEnquiry::create([
            ...$validated,
            'status' => 'new',
        ]);

        return redirect()->route('wholesale')->with(
            'wholesale_success',
            'Thank you! Your wholesale application has been received by our commercial team in Buguruni Malapa. We will contact you within 2 business hours with tier pricing and sample options.'
        );
    }
}
