<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Volunteer;
use App\Models\Contact;
use App\Models\Program;
use App\Models\Post;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_donations' => Donation::where('status', 'completed')->sum('amount') ?? 0,
            'donations_count' => Donation::where('status', 'completed')->count(),
            'programs_count' => Program::count(),
            'volunteers_count' => Volunteer::count(),
            'posts_count' => Post::count(),
            'pending_volunteers' => Volunteer::where('status', 'pending')->count(),
            'unread_messages' => Contact::count(),
        ];

        $recentDonations = Donation::with('program')
            ->latest()
            ->take(5)
            ->get();

        $recentVolunteers = Volunteer::latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentDonations', 'recentVolunteers', 'recentContacts'));
    }
}
