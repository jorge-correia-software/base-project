<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('author')->latest()->paginate(15);
        $trashedCount = Page::onlyTrashed()->count();
        return view('admin.pages.index', compact('pages', 'trashedCount'));
    }

    public function create()
    {
        $parentPages = Page::all(); // For parent selection
        $media = Media::where('file_type', 'image')->latest()->get();
        return view('admin.pages.create', compact('parentPages', 'media'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:pages,slug',
            'content' => 'nullable',
            'excerpt' => 'nullable',
            'featured_image_id' => 'nullable|exists:media,id',
            'parent_id' => 'nullable|exists:pages,id',
            'template' => 'required|string',
            'status' => 'required|in:draft,published',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['author_id'] = auth()->id();
        $validated['published_at'] = $validated['status'] === 'published' ? now() : null;

        Page::create($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page created successfully');
    }

    public function edit(Page $page)
    {
        $parentPages = Page::where('id', '!=', $page->id)->get();
        $media = Media::where('file_type', 'image')->latest()->get();
        return view('admin.pages.edit', compact('page', 'parentPages', 'media'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:pages,slug,' . $page->id,
            'content' => 'nullable',
            'excerpt' => 'nullable',
            'featured_image_id' => 'nullable|exists:media,id',
            'parent_id' => 'nullable|exists:pages,id',
            'template' => 'required|string',
            'status' => 'required|in:draft,published',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

        if ($validated['status'] === 'published' && !$page->published_at) {
            $validated['published_at'] = now();
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page updated successfully');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page deleted successfully');
    }

    public function bulkUpdate(Request $request)
    {
        $validated = $request->validate([
            'pages' => 'required|array',
            'pages.*.id' => 'required|exists:pages,id',
            'pages.*.title' => 'required|string|max:255',
            'pages.*.status' => 'required|in:draft,published',
        ]);

        try {
            $updatedCount = 0;

            DB::transaction(function () use ($validated, &$updatedCount) {
                foreach ($validated['pages'] as $pageData) {
                    $page = Page::findOrFail($pageData['id']);

                    $page->update([
                        'title' => $pageData['title'],
                        'status' => $pageData['status'],
                    ]);

                    $updatedCount++;
                }
            });

            return response()->json([
                'success' => true,
                'message' => $updatedCount . ' page' . ($updatedCount > 1 ? 's' : '') . ' updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update pages: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkDeletable(Request $request)
    {
        $validated = $request->validate([
            'page_ids' => 'required|array',
            'page_ids.*' => 'required|exists:pages,id'
        ]);

        try {
            $pages = Page::whereIn('id', $validated['page_ids'])->get();

            $deletable = [];
            $protected = [];

            foreach ($pages as $page) {
                if ($page->canBeDeleted()) {
                    $deletable[] = $page->id;
                } else {
                    $blockers = $page->getDeletionBlockers();
                    $protected[] = [
                        'id' => $page->id,
                        'name' => $page->title,
                        'blockers' => $blockers
                    ];
                }
            }

            return response()->json([
                'success' => true,
                'deletable' => $deletable,
                'protected' => $protected
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to check pages: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'page_ids' => 'required|array',
            'page_ids.*' => 'required|exists:pages,id'
        ]);

        try {
            DB::transaction(function () use ($validated) {
                Page::whereIn('id', $validated['page_ids'])->delete();
            });

            $count = count($validated['page_ids']);
            $message = $count . ' page' . ($count > 1 ? 's' : '') . ' deleted successfully.';

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete pages: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bin(Request $request)
    {
        $query = Page::onlyTrashed()->with(['author']);

        // Sort
        $sortBy = $request->get('sort_by', 'deleted_at');
        $sortDir = $request->get('sort_dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        $pages = $query->paginate(15);

        return view('admin.pages.bin', compact('pages'));
    }

    public function bulkRestore(Request $request)
    {
        $validated = $request->validate([
            'page_ids' => 'required|array',
            'page_ids.*' => 'required|exists:pages,id'
        ]);

        try {
            DB::transaction(function () use ($validated) {
                Page::onlyTrashed()
                    ->whereIn('id', $validated['page_ids'])
                    ->get()
                    ->each(function ($page) {
                        $page->restore();
                    });
            });

            $count = count($validated['page_ids']);
            $message = $count . ' page' . ($count > 1 ? 's' : '') . ' restored successfully';

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to restore pages: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkPermanentDelete(Request $request)
    {
        $validated = $request->validate([
            'page_ids' => 'required|array',
            'page_ids.*' => 'required|exists:pages,id'
        ]);

        try {
            $deletedCount = 0;
            $protectedPages = [];

            DB::transaction(function () use ($validated, &$deletedCount, &$protectedPages) {
                $pages = Page::onlyTrashed()
                    ->whereIn('id', $validated['page_ids'])
                    ->get();

                foreach ($pages as $page) {
                    // Check if page can be permanently deleted
                    if ($page->canBeDeleted()) {
                        $page->forceDelete();
                        $deletedCount++;
                    } else {
                        $blockers = $page->getDeletionBlockers();
                        $protectedPages[] = $page->title . ' (' . implode(', ', $blockers) . ')';
                    }
                }
            });

            // Build response message
            $message = '';
            if ($deletedCount > 0) {
                $message = $deletedCount . ' page' . ($deletedCount > 1 ? 's' : '') . ' permanently deleted.';
            }

            if (!empty($protectedPages)) {
                if ($message) {
                    $message .= ' ';
                }
                $message .= 'Cannot permanently delete ' . count($protectedPages) . ' page' . (count($protectedPages) > 1 ? 's' : '') . ': ' . implode(', ', $protectedPages);
            }

            return response()->json([
                'success' => $deletedCount > 0,
                'message' => $message ?: 'No pages were permanently deleted'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to permanently delete pages: ' . $e->getMessage()
            ], 500);
        }
    }
}
