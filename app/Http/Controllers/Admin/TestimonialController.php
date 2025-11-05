<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Media;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        $media = Media::where('file_type', 'image')->latest()->get();
        return view('admin.testimonials.create', compact('media'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_name' => 'required|max:255',
            'author_title' => 'nullable|string',
            'author_company' => 'nullable|string',
            'author_photo_id' => 'nullable|exists:media,id',
            'content' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully');
    }

    public function edit(Testimonial $testimonial)
    {
        $media = Media::where('file_type', 'image')->latest()->get();
        return view('admin.testimonials.edit', compact('testimonial', 'media'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'author_name' => 'required|max:255',
            'author_title' => 'nullable|string',
            'author_company' => 'nullable|string',
            'author_photo_id' => 'nullable|exists:media,id',
            'content' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:testimonials,id',
        ]);

        foreach ($request->order as $index => $id) {
            Testimonial::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
