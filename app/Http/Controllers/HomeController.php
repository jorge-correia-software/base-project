<?php

namespace App\Http\Controllers;

use App\Mail\ActivityRegistrationSubmitted;
use App\Mail\ActivityRegistrationReceived;
use App\Models\Program;
use App\Models\Post;
use App\Models\Activity;
use App\Models\Highlight;
use App\Models\SupportArea;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            'title' => 'BASE - Activities',
            'description' => 'Browse all upcoming activities and events designed to support your business journey.',
            'keywords' => 'business activities scotland, business events, workshops, networking',
        ];

        return view('activities', compact('activities', 'seo'));
    }

    public function show(Activity $activity)
    {
        // Get related activities (same name, upcoming dates only, exclude current)
        $relatedActivities = Activity::where('name', $activity->name)
            ->where('date', '>=', now())
            ->where('id', '!=', $activity->id)
            ->orderBy('date')
            ->limit(3)
            ->get();

        $seo = [
            'title' => 'BASE - ' . $activity->name,
            'description' => Str::limit($activity->description, 155),
            'keywords' => 'business activities scotland, ' . strtolower($activity->company) . ', ' . strtolower($activity->name),
        ];

        return view('activity', compact('activity', 'relatedActivities', 'seo'));
    }

    public function support()
    {
        $supportAreas = SupportArea::where('is_active', true)
            ->orderBy('order')
            ->limit(3)
            ->get();

        $seo = [
            'title' => 'BASE - Support',
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
            'title' => 'BASE - Highlights',
            'description' => 'Browse the latest highlights, events, and inspiring success stories from our business community.',
            'keywords' => 'success stories, business highlights, events, testimonials',
        ];

        return view('highlights', compact('highlights', 'seo'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'activity_name' => 'required|string',
            'activity_date' => 'required|date',
            'activity_time' => 'nullable|string',
            'activity_location' => 'nullable|string',
            'activity_price' => 'nullable|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Create message with activity details and user info
        $message = "Activity Registration:\n\n";
        $message .= "Activity: {$validated['activity_name']}\n";
        $message .= "Date: {$validated['activity_date']}\n";
        $message .= "Time: " . ($validated['activity_time'] ?? 'N/A') . "\n";
        $message .= "Location: " . ($validated['activity_location'] ?? 'N/A') . "\n";
        $message .= "Price: {$validated['activity_price']}\n\n";
        $message .= "Registrant Details:\n";
        $message .= "Name: {$validated['name']}\n";
        $message .= "Email: {$validated['email']}";

        $submission = ContactSubmission::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => "Activity Registration: {$validated['activity_name']}",
            'message' => $message,
            'type' => 'registration',
            'ip_address' => $request->ip(),
        ]);

        // Send emails synchronously
        try {
            // Admin notification
            Mail::to(config('mail.admin_email', 'info@hub-base.co.uk'))
                ->send(new ActivityRegistrationSubmitted($submission));

            // Customer confirmation
            Mail::to($validated['email'])
                ->send(new ActivityRegistrationReceived($submission));

            return redirect()->back()->with('success', 'Your registration has been confirmed! We\'ve sent you a confirmation email.');
        } catch (\Exception $e) {
            // Log error but still show success to user (submission was saved)
            Log::error('Activity registration email failed: ' . $e->getMessage());

            return redirect()->back()->with('success', 'Your registration has been submitted successfully! We will contact you shortly.');
        }
    }
}
