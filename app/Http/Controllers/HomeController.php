<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Post;
use App\Models\Activity;
use App\Models\Highlight;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $programs = Program::where('is_active', true)
            ->orderBy('order')
            ->get();

        $posts = Post::published()
            ->with(['category', 'featuredImage'])
            ->latest('published_at')
            ->take(3)
            ->get();

        $activities = Activity::where('date', '>=', now())
            ->orderBy('date')
            ->orderBy('name')
            ->take(3)
            ->get();

        $highlights = Highlight::orderBy('date', 'desc')
            ->take(3)
            ->get();

        $seo = [
            'title' => 'BASE - Business Acceleration and Support Enterprise',
            'description' => 'Empowering Business Growth in Scotland. Comprehensive support, funding opportunities, and expert guidance for Scottish businesses.',
            'keywords' => 'business support scotland, grants scotland, business funding, scottish startups, business acceleration',
        ];

        return view('landing', compact('programs', 'posts', 'activities', 'highlights', 'seo'));
    }
}
