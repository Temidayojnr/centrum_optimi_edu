<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $query = Donation::with('program')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        $donations = $query->paginate(20);
        $programs = \App\Models\Program::orderBy('name')->get();

        return view('admin.donations.index', compact('donations', 'programs'));
    }

    public function show(Donation $donation)
    {
        $donation->load('program');
        return view('admin.donations.show', compact('donation'));
    }
}
