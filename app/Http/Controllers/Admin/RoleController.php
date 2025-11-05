<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    // Available permissions for the system
    protected $availablePermissions = [
        'pages' => ['create', 'edit', 'delete', 'publish'],
        'posts' => ['create', 'edit', 'delete', 'publish'],
        'media' => ['upload', 'delete'],
        'programs' => ['create', 'edit', 'delete'],
        'support_areas' => ['create', 'edit', 'delete'],
        'testimonials' => ['create', 'edit', 'delete'],
        'hero_sections' => ['create', 'edit', 'delete'],
        'categories' => ['create', 'edit', 'delete'],
        'tags' => ['create', 'edit', 'delete'],
        'menus' => ['create', 'edit', 'delete'],
        'users' => ['create', 'edit', 'delete'],
        'roles' => ['create', 'edit', 'delete'],
        'settings' => ['edit'],
        'contact_submissions' => ['view', 'delete'],
    ];

    public function index()
    {
        $roles = Role::withCount('users')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $availablePermissions = $this->availablePermissions;
        return view('admin.roles.create', compact('availablePermissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|unique:roles,slug',
            'description' => 'nullable|string',
            'permissions' => 'nullable|array',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['permissions'] = $validated['permissions'] ?? [];

        Role::create($validated);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        $availablePermissions = $this->availablePermissions;
        return view('admin.roles.edit', compact('role', 'availablePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|unique:roles,slug,' . $role->id,
            'description' => 'nullable|string',
            'permissions' => 'nullable|array',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['permissions'] = $validated['permissions'] ?? [];

        $role->update($validated);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        // Prevent deleting role if it has users
        if ($role->users()->count() > 0) {
            return back()->with('error', 'Cannot delete role with assigned users. Please reassign users first.');
        }

        // Prevent deleting system roles
        if (in_array($role->slug, ['admin', 'editor', 'author'])) {
            return back()->with('error', 'Cannot delete system roles');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
