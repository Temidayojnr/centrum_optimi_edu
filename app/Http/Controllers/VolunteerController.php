<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function index()
    {
        return view('get-involved');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteers,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:255',
            'skills' => 'nullable|string',
            'why_volunteer' => 'required|string',
            'availability' => 'required|in:weekdays,weekends,both,flexible',
        ]);

        Volunteer::create($validated);

        // Send confirmation email
        // Mail::to($validated['email'])->send(new VolunteerApplicationReceived());

        return back()->with('success', 'Thank you for your interest! We will review your application and get back to you soon.');
    }
}
