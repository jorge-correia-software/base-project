<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Post;
use App\Models\Activity;
use App\Models\Highlight;
use App\Models\SupportArea;
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
            'title' => 'BASE - Business Advice and Support for Entrepreneurs',
            'description' => 'Empowering Business Growth in Scotland. Comprehensive support, funding opportunities, and expert guidance for Scottish businesses.',
            'keywords' => 'business support scotland, grants scotland, business funding, scottish startups, business acceleration',
        ];

        return view('landing', compact('programs', 'posts', 'activities', 'highlights', 'seo'));
    }

    public function activities(Request $request)
    {
        $query = Activity::where('date', '>=', now());

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%");
            });
        }

        // Company filter
        if ($request->filled('filter') && $request->input('filter') !== 'all') {
            $company = $request->input('filter') === 'brt' ? 'BRT' : 'Elevator';
            $query->where('company', $company);
        }

        // Sorting
        $sortBy = $request->input('sort', 'date');
        if ($sortBy === 'name') {
            $query->orderBy('name');
        } elseif ($sortBy === 'price') {
            $query->orderByRaw("CASE WHEN price = 'Free' THEN 0 ELSE 1 END")
                  ->orderByRaw("CAST(REPLACE(price, '£', '') AS UNSIGNED)");
        } else {
            $query->orderBy('date')->orderBy('name');
        }

        // Pagination
        $perPage = $request->input('per_page', 6);
        $activities = $query->paginate((int)$perPage)->appends($request->except('page'));

        $seo = [
            'title' => 'Activities - BASE Scotland',
            'description' => 'Browse all upcoming activities and events designed to support your business journey.',
            'keywords' => 'business activities scotland, business events, workshops, networking',
        ];

        return view('activities', compact('activities', 'seo'));
    }

    public function support()
    {
        $supportAreas = SupportArea::paginate(12);

        $seo = [
            'title' => 'Support Areas - BASE Scotland',
            'description' => 'Explore comprehensive business support across key areas to help your company thrive and grow.',
            'keywords' => 'business support scotland, financial guidance, mentorship, legal support, marketing',
        ];

        return view('support', compact('supportAreas', 'seo'));
    }

    public function highlights()
    {
        $highlights = Highlight::orderBy('date', 'desc')
            ->paginate(12);

        $seo = [
            'title' => 'Highlights & Success Stories - BASE Scotland',
            'description' => 'Browse the latest highlights, events, and inspiring success stories from our business community.',
            'keywords' => 'success stories, business highlights, events, testimonials',
        ];

        return view('highlights', compact('highlights', 'seo'));
    }
}
