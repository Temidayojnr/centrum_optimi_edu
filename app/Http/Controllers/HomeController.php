<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Post;
use App\Models\GalleryItem;
use App\Models\Donation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featured_programs = Program::where('is_published', true)
            ->where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        $recent_posts = Post::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $gallery_items = GalleryItem::featured()
            ->images()
            ->take(6)
            ->get();

        $total_donated = Donation::successful()->sum('amount');
        $total_beneficiaries = Program::where('is_published', true)->sum('beneficiaries');

        return view('welcome', compact(
            'featured_programs',
            'recent_posts',
            'gallery_items',
            'total_donated',
            'total_beneficiaries'
        ));
    }
}
