<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WholesaleEnquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminWholesaleController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->get('status');
        $query = WholesaleEnquiry::latest();

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        $enquiries = $query->paginate(20);
        return view('admin.wholesale.index', compact('enquiries'));
    }

    public function show(WholesaleEnquiry $wholesale): View
    {
        return view('admin.wholesale.show', compact('wholesale'));
    }

    public function update(Request $request, WholesaleEnquiry $wholesale): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:new,contacted,negotiating,approved,closed',
            'admin_notes' => 'nullable|string',
        ]);

        $wholesale->update($validated);

        return back()->with('success', 'Wholesale lead updated.');
    }
}
