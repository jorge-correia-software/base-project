<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use App\Models\Media;
use App\Models\ContactSubmission;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'pages' => Page::count(),
            'posts' => Post::count(),
            'media' => Media::count(),
            'users' => User::count(),
            'contact_submissions' => ContactSubmission::where('status', 'new')->count(),
        ];

        $recentPosts = Post::with('author')->latest()->take(5)->get();
        $recentSubmissions = ContactSubmission::where('status', 'new')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPosts', 'recentSubmissions'));
    }
}
