<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleryItems = GalleryItem::with('program')->latest()->paginate(20);
        $programs = Program::orderBy('name')->get();
        return view('admin.gallery.index', compact('galleryItems', 'programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240',
            'type' => 'required|in:image,video',
            'program_id' => 'nullable|exists:programs,id',
            'category' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
        ]);

        $validated['file_path'] = $request->file('file')->store('gallery', 'public');

        GalleryItem::create($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item added successfully.');
    }

    public function update(Request $request, GalleryItem $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'program_id' => 'nullable|exists:programs,id',
            'category' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
        ]);

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(GalleryItem $gallery)
    {
        Storage::disk('public')->delete($gallery->file_path);
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted successfully.');
    }
}
