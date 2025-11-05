<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author', 'category'])->latest()->paginate(15);
        $trashedCount = Post::onlyTrashed()->count();
        return view('admin.posts.index', compact('posts', 'trashedCount'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $media = Media::where('file_type', 'image')->latest()->get();
        return view('admin.posts.create', compact('categories', 'tags', 'media'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:posts,slug',
            'content' => 'nullable',
            'excerpt' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'featured_image_id' => 'nullable|exists:media,id',
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['author_id'] = auth()->id();

        if ($validated['status'] === 'published' && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $tags = $validated['tags'] ?? [];
        unset($validated['tags']);

        $post = Post::create($validated);
        $post->tags()->sync($tags);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post created successfully');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $media = Media::where('file_type', 'image')->latest()->get();
        $selectedTags = $post->tags->pluck('id')->toArray();

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'media', 'selectedTags'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:posts,slug,' . $post->id,
            'content' => 'nullable',
            'excerpt' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'featured_image_id' => 'nullable|exists:media,id',
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

        if ($validated['status'] === 'published' && !$post->published_at) {
            $validated['published_at'] = now();
        }

        $tags = $validated['tags'] ?? [];
        unset($validated['tags']);

        $post->update($validated);
        $post->tags()->sync($tags);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully');
    }

    public function bulkUpdate(Request $request)
    {
        $validated = $request->validate([
            'posts' => 'required|array',
            'posts.*.id' => 'required|exists:posts,id',
            'posts.*.title' => 'required|string|max:255',
            'posts.*.status' => 'required|in:draft,scheduled,published',
        ]);

        try {
            $updatedCount = 0;

            DB::transaction(function () use ($validated, &$updatedCount) {
                foreach ($validated['posts'] as $postData) {
                    $post = Post::findOrFail($postData['id']);

                    $post->update([
                        'title' => $postData['title'],
                        'status' => $postData['status'],
                    ]);

                    $updatedCount++;
                }
            });

            return response()->json([
                'success' => true,
                'message' => $updatedCount . ' post' . ($updatedCount > 1 ? 's' : '') . ' updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update posts: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkDeletable(Request $request)
    {
        $validated = $request->validate([
            'post_ids' => 'required|array',
            'post_ids.*' => 'required|exists:posts,id'
        ]);

        try {
            $posts = Post::whereIn('id', $validated['post_ids'])->get();

            // All posts can be deleted
            $deletable = $posts->pluck('id')->toArray();
            $protected = [];

            return response()->json([
                'success' => true,
                'deletable' => $deletable,
                'protected' => $protected
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to check posts: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'post_ids' => 'required|array',
            'post_ids.*' => 'required|exists:posts,id'
        ]);

        try {
            DB::transaction(function () use ($validated) {
                Post::whereIn('id', $validated['post_ids'])->delete();
            });

            $count = count($validated['post_ids']);
            $message = $count . ' post' . ($count > 1 ? 's' : '') . ' deleted successfully.';

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete posts: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bin(Request $request)
    {
        $query = Post::onlyTrashed()->with(['author', 'category']);

        // Sort
        $sortBy = $request->get('sort_by', 'deleted_at');
        $sortDir = $request->get('sort_dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        $posts = $query->paginate(15);

        return view('admin.posts.bin', compact('posts'));
    }

    public function bulkRestore(Request $request)
    {
        $validated = $request->validate([
            'post_ids' => 'required|array',
            'post_ids.*' => 'required|exists:posts,id'
        ]);

        try {
            DB::transaction(function () use ($validated) {
                Post::onlyTrashed()
                    ->whereIn('id', $validated['post_ids'])
                    ->get()
                    ->each(function ($post) {
                        $post->restore();
                    });
            });

            $count = count($validated['post_ids']);
            $message = $count . ' post' . ($count > 1 ? 's' : '') . ' restored successfully';

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to restore posts: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkPermanentDelete(Request $request)
    {
        $validated = $request->validate([
            'post_ids' => 'required|array',
            'post_ids.*' => 'required|exists:posts,id'
        ]);

        try {
            $deletedCount = 0;
            $protectedPosts = [];

            DB::transaction(function () use ($validated, &$deletedCount, &$protectedPosts) {
                $posts = Post::onlyTrashed()
                    ->whereIn('id', $validated['post_ids'])
                    ->get();

                foreach ($posts as $post) {
                    // Check if post can be permanently deleted
                    if ($post->canBeDeleted()) {
                        $post->forceDelete();
                        $deletedCount++;
                    } else {
                        $blockers = $post->getDeletionBlockers();
                        $protectedPosts[] = $post->title . ' (' . implode(', ', $blockers) . ')';
                    }
                }
            });

            // Build response message
            $message = '';
            if ($deletedCount > 0) {
                $message = $deletedCount . ' post' . ($deletedCount > 1 ? 's' : '') . ' permanently deleted.';
            }

            if (!empty($protectedPosts)) {
                if ($message) {
                    $message .= ' ';
                }
                $message .= 'Cannot permanently delete ' . count($protectedPosts) . ' post' . (count($protectedPosts) > 1 ? 's' : '') . ': ' . implode(', ', $protectedPosts);
            }

            return response()->json([
                'success' => $deletedCount > 0,
                'message' => $message ?: 'No posts were permanently deleted'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to permanently delete posts: ' . $e->getMessage()
            ], 500);
        }
    }
}
