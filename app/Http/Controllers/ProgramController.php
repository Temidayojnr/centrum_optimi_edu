<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = Program::where('is_published', true);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $programs = $query->latest()->paginate(9);

        return view('programs.index', compact('programs'));
    }

    public function show(Program $program)
    {
        if (!$program->is_published) {
            abort(404);
        }

        $program->load('galleryItems');
        $relatedPrograms = Program::where('is_published', true)
            ->where('id', '!=', $program->id)
            ->where('status', $program->status)
            ->take(3)
            ->get();

        return view('programs.show', compact('program', 'relatedPrograms'));
    }
}
