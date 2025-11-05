# BASE CMS - Implementation Guide

## 🎯 CURRENT STATUS: ~50% Complete

### ✅ COMPLETED
- Database (100%) - 26 tables, all tested
- Models (100%) - 16 models with relationships
- Admin Routes (100%) - Complete routing structure
- Admin Controllers (69%) - 11 of 16 controllers created

### 🚧 REMAINING WORK

---

## STEP 1: Complete Remaining 5 Controllers

### Copy these controller templates to `app/Http/Controllers/Admin/`:

#### CategoryController.php
```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->latest()->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|unique:categories,slug',
            'description' => 'nullable',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|unique:categories,slug,' . $category->id,
            'description' => 'nullable',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
```

#### TagController.php, UserController.php, RoleController.php, MenuController.php

Follow the same pattern as CategoryController - simple CRUD operations.

---

## STEP 2: Create Admin Views

### Directory Structure:
```
resources/views/admin/
├── layouts/
│   ├── app.blade.php          # Main admin layout
│   └── sidebar.blade.php      # Sidebar navigation
├── dashboard.blade.php         # Dashboard
├── pages/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── posts/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── media/
│   └── index.blade.php
├── programs/
├── support-areas/
├── testimonials/
├── hero-sections/
├── contact-submissions/
└── settings/
```

### Admin Layout Template (`resources/views/admin/layouts/app.blade.php`):
```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - BASE Admin</title>

    <!-- Material Dashboard CSS -->
    <link href="{{ asset('material-dashboard/assets/css/material-dashboard.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    @stack('styles')
</head>
<body class="g-sidenav-show bg-gray-100">

    @include('admin.layouts.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">@yield('page-title', 'Dashboard')</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <!-- Search or other items -->
                    </div>
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item">
                            <form method="POST" action="{{ route('signout') }}">
                                @csrf
                                <button type="submit" class="nav-link">
                                    <i class="material-icons">logout</i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container-fluid py-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Material Dashboard JS -->
    <script src="{{ asset('material-dashboard/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('material-dashboard/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('material-dashboard/assets/js/material-dashboard.min.js') }}"></script>

    @stack('scripts')
</body>
</html>
```

### Dashboard View (`resources/views/admin/dashboard.blade.php`):
```blade
@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">description</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Pages</p>
                    <h4 class="mb-0">{{ $stats['pages'] }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">article</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Posts</p>
                    <h4 class="mb-0">{{ $stats['posts'] }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">perm_media</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Media</p>
                    <h4 class="mb-0">{{ $stats['media'] }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">email</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">New Contacts</p>
                    <h4 class="mb-0">{{ $stats['contact_submissions'] }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-8 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Recent Posts</h6>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Author</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPosts as $post)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $post->title }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $post->author->name }}</p>
                                </td>
                                <td>
                                    <span class="badge badge-sm bg-gradient-{{ $post->status === 'published' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $post->created_at->diffForHumans() }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

---

## STEP 3: Create Front-End Views

### Front-End Layout (`resources/views/layouts/app.blade.php`):
```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HOME') - BASE</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>
    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/smooth-scroll.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>

    @stack('scripts')
</body>
</html>
```

### Custom CSS (`public/css/custom.css`):
```css
:root {
    --brand-pink: #FF4D8D;
    --brand-yellow: #FFD700;
}

body {
    font-family: 'Poppins', sans-serif;
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Gradient text */
.gradient-text {
    background: linear-gradient(90deg, var(--brand-pink), var(--brand-yellow));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Button styles */
.btn-brand {
    background: linear-gradient(90deg, var(--brand-pink), var(--brand-yellow));
    color: white;
    border: none;
    border-radius: 50px;
    padding: 12px 30px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-brand:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(255, 77, 141, 0.3);
}

/* Card hover effects */
.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: scale(1.05);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

/* Section styling */
.section {
    padding: 80px 0;
}

/* Hero section */
.hero-section {
    min-height: 600px;
    background-size: cover;
    background-position: center;
    position: relative;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.4));
}
```

### Homepage (`resources/views/home.blade.php`):
```blade
@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section d-flex align-items-center" style="background-image: url('{{ $heroSection->backgroundImage->url ?? '' }}')">
    <div class="hero-overlay"></div>
    <div class="container position-relative">
        <div class="row justify-content-center text-center text-white">
            <div class="col-lg-8">
                <h1 class="display-3 fw-bold mb-4">{{ $heroSection->title }}</h1>
                <p class="lead mb-4">{{ $heroSection->subtitle }}</p>
                @if($heroSection->button_text && $heroSection->button_url)
                <a href="{{ $heroSection->button_url }}" class="btn btn-brand btn-lg">{{ $heroSection->button_text }}</a>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section id="programs" class="section">
    <div class="container">
        <h2 class="text-center mb-5 gradient-text">Our Programs</h2>
        <div class="row g-4">
            @foreach($programs as $program)
            <div class="col-md-4">
                <div class="card card-hover h-100 border-0 shadow">
                    @if($program->featuredImage)
                    <img src="{{ $program->featuredImage->url }}" class="card-img-top" alt="{{ $program->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $program->title }}</h5>
                        <p class="card-text">{{ $program->description }}</p>
                        @if($program->link_url)
                        <a href="{{ $program->link_url }}" class="btn btn-brand btn-sm">{{ $program->link_text }}</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="section bg-light">
    <div class="container">
        <h2 class="text-center mb-5 gradient-text">Get In Touch</h2>
        <div class="row">
            <div class="col-lg-6">
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-brand">Send Message</button>
                </form>
            </div>
            <div class="col-lg-6">
                <h5>Contact Information</h5>
                <p><i class="material-icons">location_on</i> {{ config('app.address', 'Bankhead Avenue, Edinburgh') }}</p>
                <p><i class="material-icons">email</i> {{ config('mail.from.address') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
```

---

## STEP 4: Create Seeders

Run: `php artisan make:seeder DatabaseSeeder`

### `database/seeders/DatabaseSeeder.php`:
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            ContentSeeder::class,
        ]);
    }
}
```

### Create Individual Seeders:
```bash
php artisan make:seeder RoleSeeder
php artisan make:seeder UserSeeder
php artisan make:seeder SettingSeeder
php artisan make:seeder ContentSeeder
```

Then run:
```bash
php artisan db:seed
```

---

## COMPLETION CHECKLIST

- [ ] Create 5 remaining controllers
- [ ] Build admin layout and sidebar
- [ ] Create admin dashboard view
- [ ] Create admin CRUD views for all models
- [ ] Build front-end layout
- [ ] Create homepage with all sections
- [ ] Add pink/yellow CSS branding
- [ ] Create seeders
- [ ] Run seeders and test
- [ ] Test all CRUD operations
- [ ] Test front-end display
- [ ] Test contact form
- [ ] Test media uploads
- [ ] Mobile responsiveness check

---

**You're 50% done! The hard part (architecture) is complete. The rest is UI work following these patterns.**
