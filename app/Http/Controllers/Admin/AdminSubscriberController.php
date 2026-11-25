<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminSubscriberController extends Controller
{
    public function index(Request $request): View
    {
        $query = NewsletterSubscriber::latest();

        if ($search = $request->get('search')) {
            $query->where('email', 'like', "%{$search}%");
        }

        $subscribers = $query->paginate(20)->withQueryString();
        $totalSubscribers = NewsletterSubscriber::count();
        $activeSubscribers = NewsletterSubscriber::where('status', 'subscribed')->count();

        return view('admin.subscribers.index', compact('subscribers', 'totalSubscribers', 'activeSubscribers'));
    }

    public function destroy(NewsletterSubscriber $subscriber): RedirectResponse
    {
        $subscriber->delete();

        return back()->with('success', 'Subscriber removed successfully.');
    }
}
