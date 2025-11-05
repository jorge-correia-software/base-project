<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportArea;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupportAreaController extends Controller
{
    public function index()
    {
        $supportAreas = SupportArea::orderBy('order')->get();
        return view('admin.support-areas.index', compact('supportAreas'));
    }

    public function create()
    {
        $media = Media::where('file_type', 'image')->latest()->get();
        return view('admin.support-areas.create', compact('media'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:support_areas,slug',
            'description' => 'required',
            'background_image_id' => 'nullable|exists:media,id',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');

        SupportArea::create($validated);

        return redirect()->route('admin.support-areas.index')
            ->with('success', 'Support area created successfully');
    }

    public function edit(SupportArea $supportArea)
    {
        $media = Media::where('file_type', 'image')->latest()->get();
        return view('admin.support-areas.edit', compact('supportArea', 'media'));
    }

    public function update(Request $request, SupportArea $supportArea)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:support_areas,slug,' . $supportArea->id,
            'description' => 'required',
            'background_image_id' => 'nullable|exists:media,id',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');

        $supportArea->update($validated);

        return redirect()->route('admin.support-areas.index')
            ->with('success', 'Support area updated successfully');
    }

    public function destroy(SupportArea $supportArea)
    {
        $supportArea->delete();

        return redirect()->route('admin.support-areas.index')
            ->with('success', 'Support area deleted successfully');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:support_areas,id',
        ]);

        foreach ($request->order as $index => $id) {
            SupportArea::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
