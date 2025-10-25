<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        // Send notification to admin
        // Mail::to(config('mail.admin_email'))->send(new NewContactMessage($validated));

        // Send confirmation to user
        // Mail::to($validated['email'])->send(new ContactConfirmation());

        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
