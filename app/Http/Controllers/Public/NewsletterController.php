<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);

        $subscriber = NewsletterSubscriber::create([
            'email' => $validated['email'],
            'is_verified' => true, // Auto-verify for simplicity
        ]);

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }

    public function unsubscribe($token)
    {
        $subscriber = NewsletterSubscriber::where('unsubscribe_token', $token)->firstOrFail();
        
        $subscriber->update([
            'unsubscribed_at' => now(),
        ]);

        return view('public.newsletter.unsubscribed');
    }
}
