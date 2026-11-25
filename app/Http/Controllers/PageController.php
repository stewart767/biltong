<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about');
    }

    public function craft(): View
    {
        return view('pages.craft');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function contactSend(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'unread',
        ]);

        return redirect()->route('contact')->with(
            'contact_success',
            'Thank you for reaching out to INAS Company Limited! Our team at Buguruni Malapa has received your message and will respond promptly.'
        );
    }

    public function newsletterSubscribe(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|max:150',
        ]);

        NewsletterSubscriber::updateOrCreate(
            ['email' => strtolower(trim($validated['email']))],
            ['status' => 'subscribed', 'ip_address' => $request->ip()]
        );

        return back()->with('success', 'Thank you for subscribing to The Butcher’s Club! You will receive fresh batch alerts.');
    }
}
