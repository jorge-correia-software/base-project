<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\SupportArea;
use App\Models\Testimonial;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $programs = Program::where('is_active', true)
            ->orderBy('order')
            ->get();

        $supportAreas = SupportArea::where('is_active', true)
            ->orderBy('order')
            ->get();

        $testimonials = Testimonial::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->take(3)
            ->get();

        $posts = Post::published()
            ->with(['category', 'featuredImage'])
            ->latest('published_at')
            ->take(3)
            ->get();

        $seo = [
            'title' => 'BASE - Business Acceleration and Support Enterprise',
            'description' => 'Empowering Business Growth in Scotland. Comprehensive support, funding opportunities, and expert guidance for Scottish businesses.',
            'keywords' => 'business support scotland, grants scotland, business funding, scottish startups, business acceleration',
        ];

        return view('landing', compact('programs', 'supportAreas', 'testimonials', 'posts', 'seo'));
    }
}
