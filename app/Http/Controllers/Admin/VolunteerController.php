<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VolunteerController extends Controller
{
    public function index(Request $request)
    {
        $query = Volunteer::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $volunteers = $query->paginate(20);

        return view('admin.volunteers.index', compact('volunteers'));
    }

    public function show(Volunteer $volunteer)
    {
        return view('admin.volunteers.show', compact('volunteer'));
    }

    public function updateStatus(Request $request, Volunteer $volunteer)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $volunteer->update($validated);

        // Send email notification to volunteer
        // Mail::to($volunteer->email)->send(new VolunteerStatusUpdated($volunteer));

        return redirect()->back()->with('success', 'Volunteer status updated successfully.');
    }
}
