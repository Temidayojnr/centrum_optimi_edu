<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\Program;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = GalleryItem::with('program');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $galleryItems = $query->latest()->paginate(12);
        $programs = Program::where('status', 'active')->get();

        return view('gallery', compact('galleryItems', 'programs'));
    }
}
