<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::withCount('items')->latest()->paginate(15);
        $trashedCount = Menu::onlyTrashed()->count();
        return view('admin.menus.index', compact('menus', 'trashedCount'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|unique:menus,slug',
            'location' => 'required|in:header,footer,sidebar',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        Menu::create($validated);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu created successfully');
    }

    public function edit(Menu $menu)
    {
        $menu->load(['items' => function ($query) {
            $query->whereNull('parent_id')->with('children')->orderBy('order');
        }]);

        $pages = Page::where('status', 'published')->get();

        return view('admin.menus.edit', compact('menu', 'pages'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|unique:menus,slug,' . $menu->id,
            'location' => 'required|in:header,footer,sidebar',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        $menu->update($validated);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu updated successfully');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu deleted successfully');
    }

    public function addItem(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'url' => 'nullable|string',
            'page_id' => 'nullable|exists:pages,id',
            'parent_id' => 'nullable|exists:menu_items,id',
            'target' => 'nullable|in:_self,_blank',
            'icon' => 'nullable|string',
            'css_class' => 'nullable|string',
        ]);

        $validated['menu_id'] = $menu->id;
        $validated['target'] = $validated['target'] ?? '_self';
        $validated['is_active'] = true;

        // Get the highest order number for this menu
        $maxOrder = $menu->items()->max('order') ?? -1;
        $validated['order'] = $maxOrder + 1;

        $item = MenuItem::create($validated);

        // Return JSON if AJAX request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Menu item added successfully',
                'item' => $item
            ]);
        }

        return back()->with('success', 'Menu item added successfully');
    }

    public function addPagesToMenu(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'page_ids' => 'required|array',
            'page_ids.*' => 'required|exists:pages,id'
        ]);

        try {
            $items = [];
            $maxOrder = $menu->items()->max('order') ?? -1;

            DB::transaction(function () use ($validated, $menu, &$items, $maxOrder) {
                foreach ($validated['page_ids'] as $index => $pageId) {
                    $page = Page::find($pageId);

                    // Check if page is already in this menu
                    $exists = $menu->items()->where('page_id', $pageId)->exists();
                    if ($exists) {
                        continue;
                    }

                    $item = MenuItem::create([
                        'menu_id' => $menu->id,
                        'page_id' => $pageId,
                        'title' => $page->title,
                        'url' => null,
                        'target' => '_self',
                        'order' => $maxOrder + $index + 1,
                        'is_active' => true,
                    ]);

                    $items[] = $item;
                }
            });

            return response()->json([
                'success' => true,
                'message' => count($items) . ' page' . (count($items) > 1 ? 's' : '') . ' added to menu',
                'items' => $items
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add pages: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateItem(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'url' => 'nullable|string',
            'page_id' => 'nullable|exists:pages,id',
            'parent_id' => 'nullable|exists:menu_items,id',
            'target' => 'nullable|in:_self,_blank',
            'icon' => 'nullable|string',
            'css_class' => 'nullable|string',
        ]);

        $menuItem->update($validated);

        // Return JSON if AJAX request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Menu item updated successfully',
                'item' => $menuItem->fresh()
            ]);
        }

        return back()->with('success', 'Menu item updated successfully');
    }

    public function deleteItem(Request $request, MenuItem $menuItem)
    {
        // Delete all children first
        $menuItem->children()->delete();
        $menuItem->delete();

        // Return JSON if AJAX request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Menu item deleted successfully'
            ]);
        }

        return back()->with('success', 'Menu item deleted successfully');
    }

    public function updateMenuStructure(Request $request, Menu $menu)
    {
        $request->validate([
            'items' => 'required|string'
        ]);

        try {
            $items = json_decode($request->items, true);

            if (!is_array($items)) {
                throw new \Exception('Invalid items structure');
            }

            DB::transaction(function () use ($items) {
                foreach ($items as $item) {
                    MenuItem::where('id', $item['id'])->update([
                        'parent_id' => $item['parent_id'],
                        'order' => $item['order']
                    ]);
                }
            });

            return response()->json([
                'success' => true,
                'message' => 'Menu structure updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update menu structure: ' . $e->getMessage()
            ], 500);
        }
    }

    public function reorderItems(Request $request, Menu $menu)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:menu_items,id',
        ]);

        foreach ($request->order as $index => $id) {
            MenuItem::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function bulkUpdate(Request $request)
    {
        $validated = $request->validate([
            'menus' => 'required|array',
            'menus.*.id' => 'required|exists:menus,id',
            'menus.*.name' => 'required|string|max:255',
            'menus.*.location' => 'required|in:header,footer,sidebar',
        ]);

        try {
            $updatedCount = 0;

            DB::transaction(function () use ($validated, &$updatedCount) {
                foreach ($validated['menus'] as $menuData) {
                    $menu = Menu::findOrFail($menuData['id']);

                    $menu->update([
                        'name' => $menuData['name'],
                        'location' => $menuData['location'],
                    ]);

                    $updatedCount++;
                }
            });

            return response()->json([
                'success' => true,
                'message' => $updatedCount . ' menu' . ($updatedCount > 1 ? 's' : '') . ' updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update menus: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkDeletable(Request $request)
    {
        $validated = $request->validate([
            'menu_ids' => 'required|array',
            'menu_ids.*' => 'required|exists:menus,id'
        ]);

        try {
            $menus = Menu::whereIn('id', $validated['menu_ids'])->get();

            $deletable = [];
            $protected = [];

            foreach ($menus as $menu) {
                if ($menu->canBeDeleted()) {
                    $deletable[] = $menu->id;
                } else {
                    $blockers = $menu->getDeletionBlockers();
                    $protected[] = [
                        'id' => $menu->id,
                        'name' => $menu->name,
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
                'message' => 'Failed to check menus: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'menu_ids' => 'required|array',
            'menu_ids.*' => 'required|exists:menus,id'
        ]);

        try {
            DB::transaction(function () use ($validated) {
                Menu::whereIn('id', $validated['menu_ids'])->delete();
            });

            $count = count($validated['menu_ids']);
            $message = $count . ' menu' . ($count > 1 ? 's' : '') . ' deleted successfully.';

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete menus: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bin(Request $request)
    {
        $query = Menu::onlyTrashed()->withCount('items');

        // Sort
        $sortBy = $request->get('sort_by', 'deleted_at');
        $sortDir = $request->get('sort_dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        $menus = $query->paginate(15);

        return view('admin.menus.bin', compact('menus'));
    }

    public function bulkRestore(Request $request)
    {
        $validated = $request->validate([
            'menu_ids' => 'required|array',
            'menu_ids.*' => 'required|exists:menus,id'
        ]);

        try {
            DB::transaction(function () use ($validated) {
                Menu::onlyTrashed()
                    ->whereIn('id', $validated['menu_ids'])
                    ->get()
                    ->each(function ($menu) {
                        $menu->restore();
                    });
            });

            $count = count($validated['menu_ids']);
            $message = $count . ' menu' . ($count > 1 ? 's' : '') . ' restored successfully';

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to restore menus: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkPermanentDelete(Request $request)
    {
        $validated = $request->validate([
            'menu_ids' => 'required|array',
            'menu_ids.*' => 'required|exists:menus,id'
        ]);

        try {
            $deletedCount = 0;
            $protectedMenus = [];

            DB::transaction(function () use ($validated, &$deletedCount, &$protectedMenus) {
                $menus = Menu::onlyTrashed()
                    ->whereIn('id', $validated['menu_ids'])
                    ->get();

                foreach ($menus as $menu) {
                    // Check if menu can be permanently deleted
                    if ($menu->canBeDeleted()) {
                        $menu->forceDelete();
                        $deletedCount++;
                    } else {
                        $blockers = $menu->getDeletionBlockers();
                        $protectedMenus[] = $menu->name . ' (' . implode(', ', $blockers) . ')';
                    }
                }
            });

            // Build response message
            $message = '';
            if ($deletedCount > 0) {
                $message = $deletedCount . ' menu' . ($deletedCount > 1 ? 's' : '') . ' permanently deleted.';
            }

            if (!empty($protectedMenus)) {
                if ($message) {
                    $message .= ' ';
                }
                $message .= 'Cannot permanently delete ' . count($protectedMenus) . ' menu' . (count($protectedMenus) > 1 ? 's' : '') . ': ' . implode(', ', $protectedMenus);
            }

            return response()->json([
                'success' => $deletedCount > 0,
                'message' => $message ?: 'No menus were permanently deleted'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to permanently delete menus: ' . $e->getMessage()
            ], 500);
        }
    }
}
