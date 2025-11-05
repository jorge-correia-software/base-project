<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\Media;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroSections = HeroSection::orderBy('order')->get();
        return view('admin.hero-sections.index', compact('heroSections'));
    }

    public function create()
    {
        $media = Media::where('file_type', 'image')->latest()->get();
        return view('admin.hero-sections.create', compact('media'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_url' => 'nullable|string',
            'background_image_id' => 'nullable|exists:media,id',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->has('is_active');

        HeroSection::create($validated);

        return redirect()->route('admin.hero-sections.index')
            ->with('success', 'Hero section created successfully');
    }

    public function edit(HeroSection $heroSection)
    {
        $media = Media::where('file_type', 'image')->latest()->get();
        return view('admin.hero-sections.edit', compact('heroSection', 'media'));
    }

    public function update(Request $request, HeroSection $heroSection)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_url' => 'nullable|string',
            'background_image_id' => 'nullable|exists:media,id',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $heroSection->update($validated);

        return redirect()->route('admin.hero-sections.index')
            ->with('success', 'Hero section updated successfully');
    }

    public function destroy(HeroSection $heroSection)
    {
        $heroSection->delete();

        return redirect()->route('admin.hero-sections.index')
            ->with('success', 'Hero section deleted successfully');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:hero_sections,id',
        ]);

        foreach ($request->order as $index => $id) {
            HeroSection::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
