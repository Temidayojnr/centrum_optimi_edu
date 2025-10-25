<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->paginate(15);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,completed,upcoming',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'beneficiaries' => 'nullable|integer|min:0',
            'budget' => 'nullable|numeric|min:0',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('programs', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']);

        Program::create($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Program created successfully.');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,completed,upcoming',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'beneficiaries' => 'nullable|integer|min:0',
            'budget' => 'nullable|numeric|min:0',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($program->featured_image) {
                Storage::disk('public')->delete($program->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('programs', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']);

        $program->update($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $program)
    {
        if ($program->featured_image) {
            Storage::disk('public')->delete($program->featured_image);
        }

        $program->delete();

        return redirect()->route('admin.programs.index')->with('success', 'Program deleted successfully.');
    }
}
