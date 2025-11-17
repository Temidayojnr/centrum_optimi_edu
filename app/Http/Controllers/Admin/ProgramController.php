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
            'short_description' => 'nullable|string|max:500',
            'description' => 'required|string',
            'objectives' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,completed,upcoming',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'beneficiaries_count' => 'nullable|integer|min:0',
            'target_amount' => 'nullable|numeric|min:0',
            'raised_amount' => 'nullable|numeric|min:0',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('programs', 'public');
        }

        // Map form fields to model fields
        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'content' => $validated['description'], // Use description as content
            'status' => $validated['status'],
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'location' => $validated['location'] ?? null,
            'beneficiaries' => $validated['beneficiaries_count'] ?? 0,
            'budget' => $validated['target_amount'] ?? null,
            'is_featured' => $request->has('is_featured') ? true : false,
            'is_published' => $request->has('is_published') ? true : false,
            'slug' => Str::slug($validated['title']),
        ];

        if (isset($validated['featured_image'])) {
            $data['featured_image'] = $validated['featured_image'];
        }

        Program::create($data);

        return redirect()->route('admin.programs.index')->with('success', 'Program created successfully.');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function show(Program $program)
    {
        return view('admin.programs.show', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'required|string',
            'objectives' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,completed,upcoming',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'beneficiaries_count' => 'nullable|integer|min:0',
            'target_amount' => 'nullable|numeric|min:0',
            'raised_amount' => 'nullable|numeric|min:0',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($program->featured_image) {
                Storage::disk('public')->delete($program->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('programs', 'public');
        }

        // Map form fields to model fields
        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'content' => $validated['description'], // Use description as content
            'status' => $validated['status'],
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'location' => $validated['location'] ?? null,
            'beneficiaries' => $validated['beneficiaries_count'] ?? 0,
            'budget' => $validated['target_amount'] ?? null,
            'is_featured' => $request->has('is_featured') ? true : false,
            'is_published' => $request->has('is_published') ? true : false,
            'slug' => Str::slug($validated['title']),
        ];

        if (isset($validated['featured_image'])) {
            $data['featured_image'] = $validated['featured_image'];
        }

        $program->update($data);

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
