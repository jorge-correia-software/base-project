<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy('order')->get();
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        $media = Media::where('file_type', 'image')->latest()->get();
        return view('admin.programs.create', compact('media'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:programs,slug',
            'description' => 'required',
            'icon' => 'nullable|string',
            'featured_image_id' => 'nullable|exists:media,id',
            'link_url' => 'nullable|url',
            'link_text' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');

        Program::create($validated);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program created successfully');
    }

    public function edit(Program $program)
    {
        $media = Media::where('file_type', 'image')->latest()->get();
        return view('admin.programs.edit', compact('program', 'media'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:programs,slug,' . $program->id,
            'description' => 'required',
            'icon' => 'nullable|string',
            'featured_image_id' => 'nullable|exists:media,id',
            'link_url' => 'nullable|url',
            'link_text' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');

        $program->update($validated);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program updated successfully');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program deleted successfully');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:programs,id',
        ]);

        foreach ($request->order as $index => $id) {
            Program::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
