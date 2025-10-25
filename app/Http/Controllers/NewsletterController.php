<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletters,email',
            'name' => 'nullable|string|max:255',
        ]);

        $newsletter = Newsletter::create([
            'email' => $validated['email'],
            'name' => $validated['name'] ?? null,
            'verification_token' => Str::random(32),
        ]);

        // Send verification email
        // Mail::to($newsletter->email)->send(new NewsletterVerification($newsletter));

        return back()->with('success', 'Please check your email to confirm your subscription.');
    }

    public function verify($token)
    {
        $newsletter = Newsletter::where('verification_token', $token)->first();

        if (!$newsletter) {
            abort(404);
        }

        $newsletter->update([
            'verified_at' => now(),
            'verification_token' => null,
        ]);

        return redirect()->route('home')->with('success', 'Your email has been verified! You are now subscribed to our newsletter.');
    }

    public function unsubscribe(Request $request)
    {
        $newsletter = Newsletter::where('email', $request->email)->first();

        if ($newsletter) {
            $newsletter->update(['is_active' => false]);
        }

        return redirect()->route('home')->with('success', 'You have been unsubscribed from our newsletter.');
    }
}
