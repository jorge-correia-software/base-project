<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of posts (blog archive)
     */
    public function index()
    {
        $posts = Post::published()
            ->with(['author', 'category', 'featuredImage'])
            ->latest('published_at')
            ->paginate(12);

        return view('posts.index', compact('posts'));
    }

    /**
     * Display the specified post and increment views
     */
    public function show(Post $post)
    {
        // Only show published posts on frontend
        if ($post->status !== 'published') {
            abort(404);
        }

        // Increment view count
        $post->increment('views');

        // Load relationships
        $post->load(['author', 'category', 'tags', 'featuredImage']);

        // Get related posts (same category, exclude current)
        $relatedPosts = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->with(['author', 'category', 'featuredImage'])
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }
}
