# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Guidance for Claude

Please ask for clarification upfront, upon the initial prompts, when you need more direction.

## Environment

This project uses **Windows PowerShell** for development. All commands in this guide are formatted for PowerShell.

- Use **Windows Terminal** or **PowerShell** (not WSL/Linux bash)
- Claude Code runs natively in PowerShell without requiring WSL
- All paths use Windows format (`C:\` instead of `/mnt/c/`)

## Documentation Reminders

Use WebFetch or WebSearch to find relevant, up-to-date documentation when working with 3rd party libraries, packages, or frameworks. Key documentation sources:

- **Laravel 12:** https://laravel.com/docs/12.x
- **PHP 8.2+:** https://www.php.net/manual/en/
- **Bootstrap 5:** https://getbootstrap.com/docs/5.3/
- **Material Dashboard 3:** Check `/material-dashboard/` directory or https://demos.creative-tim.com/material-dashboard/
- **Blade Templates:** https://laravel.com/docs/12.x/blade
- **Eloquent ORM:** https://laravel.com/docs/12.x/eloquent

## Commands

```powershell
composer install                                                   # Install dependencies
C:\xampp\php\php.exe artisan serve --host=127.0.0.1 --port=8000    # Start development server
C:\xampp\php\php.exe artisan migrate:fresh --seed                  # Reset database and seed data
C:\xampp\php\php.exe artisan optimize:clear                        # Clear all caches
C:\xampp\php\php.exe artisan test                                  # Run tests
composer test                                                      # Run tests (shortcut)

# Queue worker (process background jobs)
C:\xampp\php\php.exe artisan queue:work                            # Run queue worker
C:\xampp\php\php.exe artisan queue:work --stop-when-empty          # Process all jobs then stop
```

## Email & Queue System

The application uses **Laravel Queues** for asynchronous email sending, providing better performance and user experience.

### Configuration

- **Queue Driver:** Database (`QUEUE_CONNECTION=database` in `.env`)
- **Queue Table:** `jobs` table stores pending jobs
- **Contact Form:** Sends 2 emails asynchronously (admin notification + customer confirmation)

### Queue Worker

The queue worker must be running to process queued jobs:

```powershell
# Development - process all jobs then stop
C:\xampp\php\php.exe artisan queue:work --stop-when-empty

# Production - keep worker running continuously
C:\xampp\php\php.exe artisan queue:work --sleep=3 --tries=3
```

**Important:** For production, use a process manager like Supervisor or Laravel Horizon to keep the queue worker running.

### Mailtrap Rate Limiting (Development Only)

The contact form uses `->later(now()->addSeconds(10))` to delay the customer email by 10 seconds to avoid Mailtrap's free tier rate limits (1 email per 10 seconds).

**For production SMTP:** Remove the delay by changing `->later()` back to `->queue()` in `ContactController.php`:

```php
// Remove delay for production SMTP (not Mailtrap)
Mail::to($validated['email'])->queue(new ContactFormReceived($submission));
```

### Testing Queued Emails

```powershell
# Submit contact form, then process queue
C:\xampp\php\php.exe artisan queue:work --stop-when-empty

# Check queue status
C:\xampp\php\php.exe artisan tinker --execute="echo DB::table('jobs')->count();"

# View failed jobs
C:\xampp\php\php.exe artisan queue:failed

# Retry failed jobs
C:\xampp\php\php.exe artisan queue:retry all
```

## Architecture Overview

This is a BASE CMS (Business Advice and Support for Entrepreneurs) for the Scottish business accelerator platform, built with:

- **Laravel 12** with Eloquent ORM and RESTful routing
- **PHP 8.2+** with type safety and modern PHP features
- **MySQL** database (base_db) with 26 tables and polymorphic relationships
- **Material Dashboard 3** for admin UI with custom BASE branding
- **Bootstrap 5** with custom color palette (Pink #FF4D8D, Yellow #FFD700)
- **Blade Templates** for server-side rendering
- **WordPress-style** role-based permission system
- **Polymorphic relationships** for Media uploads and SEO metadata
- **Hierarchical structures** for Categories, Pages, and Menus
- **Database-backed** sessions and queue system
- **XAMPP** environment (Windows PowerShell)

## Architecture

### Routing Structure

The application uses **three separate route files**:

1. **`routes/web.php`** - Public front-end routes (homepage, blog, contact form)
2. **`routes/admin.php`** - Admin panel routes (all prefixed with `/admin` and require authentication)
3. **`routes/auth.php`** - Authentication routes (signin, signup, password reset - all under `/admin` prefix)

Admin routes are loaded via `bootstrap/app.php` configuration:
```php
then: function () {
    Route::middleware('web')->group(base_path('routes/admin.php'));
}
```

### Authentication & Access

- **Admin Login URL:** `http://127.0.0.1:8000/admin/signin`
- **Dashboard:** `http://127.0.0.1:8000/admin/dashboard`
- **Default Admin Credentials:**
  - Email: `admin@base-scotland.com`
  - Password: `password`

Authentication redirects are configured in `bootstrap/app.php`:
- Guests redirect to `/admin/signin`
- Authenticated users redirect to `/admin/dashboard`

### Database Architecture (26 Tables)

**Core Laravel Tables:**
- `users`, `password_reset_tokens`, `sessions`
- `cache`, `cache_locks`
- `jobs`, `job_batches`, `failed_jobs`

**CMS Core Tables:**
- `roles`, `role_user` (many-to-many) - WordPress-style permissions
- `media` - File uploads with polymorphic relationships
- `categories` (hierarchical via `parent_id`)
- `tags`, `post_tag` (many-to-many)
- `posts` (with `author_id`, `category_id`, `featured_image_id`)
- `pages` (hierarchical via `parent_id`)
- `menus`, `menu_items` (hierarchical via `parent_id`)
- `settings` - Key-value with grouping
- `seo_meta` (polymorphic - `seoable_type`, `seoable_id`)
- `contact_submissions`

**BASE-Specific Tables:**
- `hero_sections` - Homepage hero carousel
- `programs` - Business programs with featured images
- `support_areas` - Support service areas
- `testimonials` - Client testimonials with photos

### Model Relationships

All 16 Eloquent models are fully implemented with relationships:

**Key Polymorphic Relationships:**
- `Media`: Polymorphic one-to-many (`mediable_type`, `mediable_id`)
- `SeoMeta`: Polymorphic one-to-one (`seoable_type`, `seoable_id`)

**Important Model Methods:**
- `User::hasRole($role)`, `User::hasPermission($permission)`
- `Setting::get($key, $default)`, `Setting::getGroup($group)`
- `Post/Page::published()`, `Post/Page::draft()` scopes
- `Media::url()`, `Media::formattedSize()` helpers

### Controller Organization

**16 Admin Controllers** in `app/Http/Controllers/Admin/`:
- `DashboardController` - Stats and recent activity
- `PageController`, `PostController` - Content CRUD with bulk operations
- `CategoryController`, `TagController` - Taxonomy management
- `MediaController` - File upload and management
- `MenuController` - Menu builder with drag-drop support
- `UserController`, `RoleController` - User management
- `ProgramController`, `SupportAreaController`, `TestimonialController`, `HeroSectionController` - BASE modules
- `ContactSubmissionController` - View submissions
- `SettingController` - Site settings

**Front-end Controllers:**
- `HomeController` - Homepage with all sections
- `PostController` - Blog listing and single post
- `ContactController` - Contact form submission

### Seeding System

Run seeders in this order (handled by `DatabaseSeeder`):
1. `RoleSeeder` - Administrator, Editor, Author roles
2. `UserSeeder` - 2 admin users (admin & editor accounts)
3. `PageSeeder` - Static pages (Privacy, Terms, Cookie Policy, FAQ)
4. `BaseContentSeeder` - Programs, Support Areas, Testimonials, Posts, Categories, Tags, Settings

Creates complete demo content: 6 programs, 8 support areas, 3 testimonials, 4 categories, 6 tags, 3 posts, 10 site settings.

## Views Organization

```
resources/views/
├── admin/              # Admin panel views (Material Dashboard 3)
│   ├── layouts/        # Admin layout and sidebar
│   ├── dashboard.blade.php
│   ├── pages/, posts/, media/, etc.  # CRUD views per model
│   └── README.md       # Documentation for admin views
├── auth/               # Authentication views (signin, signup, forgot password)
├── layouts/            # Front-end layouts
├── partials/           # Reusable partials (navbar, footer)
├── components/         # Blade components
├── sections/           # Page sections
└── landing.blade.php   # Main landing page
```

**Admin UI:** Material Dashboard 3 assets in `/material-dashboard/` directory.

## Material Dashboard & Component Library

The admin interface uses **Material Dashboard 3**, a comprehensive component library:
- Pre-built components in `/material-dashboard/` directory
- **Bootstrap 5** as the base CSS framework
- **Material Icons** icon library throughout the interface
- Custom **Blade components** in `resources/views/components/` for reusable UI elements
- Pre-built admin components: Cards, tables, forms, modals, sidebars, navbars
- Material Design styling with BASE color customization (Pink #FF4D8D, Yellow #FFD700)

When building admin views, leverage existing Material Dashboard components rather than creating from scratch.

## Branding & Design

**Color Scheme:**
- Primary Pink: `#FF4D8D`
- Accent Yellow: `#FFD700`
- Material Dashboard theme with custom BASE colors

**CSS/JS:**
- Custom CSS: `public/css/custom.css`
- Smooth scroll: `public/js/smooth-scroll.js`
- Navbar: `public/js/navbar.js`

Design patterns: Rounded cards, hover scale effects, shadow elevations, smooth transitions (300-500ms).

## Visual Development

### Design Principles

A comprehensive S-Tier SaaS Dashboard Design Checklist is maintained in `/context/design-principles.md` (inspired by Stripe, Airbnb, Linear). **Always refer to this file when making front-end, UI/UX, or admin interface changes** to ensure consistency with established design standards, accessibility requirements, and user experience patterns.

### Quick Visual Check

IMMEDIATELY after implementing any front-end change, follow this verification process:

1. **Identify what changed** - Review the modified Blade views/components in `resources/views/`
2. **Navigate to affected pages** - Use `mcp__playwright__browser_navigate` to visit each changed view at `http://127.0.0.1:8000/...`
3. **Verify design compliance** - Compare against `/context/design-principles.md` and `/context/style-guide.md` (if exists)
4. **Validate functionality** - Ensure the change fulfills the user's specific request
5. **Check acceptance criteria** - Review any provided context files or requirements
6. **Capture evidence** - Use `mcp__playwright__browser_take_screenshot` to take full-page screenshots at desktop viewport (1440px) of each changed view
7. **Check for errors** - Use `mcp__playwright__browser_console_messages` to check for JavaScript errors, and review Laravel logs (`storage/logs/laravel.log`)

This verification ensures changes meet design standards and user requirements.

### Comprehensive Design Review

Invoke the `@agent-design-review` subagent (using the Task tool) for thorough design validation when:
- Completing significant UI/UX features
- Before finalizing PRs with visual changes
- Needing comprehensive accessibility and responsiveness testing

The design review agent will validate against `/context/design-principles.md` and `/context/style-guide.md` (if exists) standards and perform thorough testing across viewports and accessibility criteria.

## Admin CRUD Pattern

Admin controllers follow a consistent pattern:
1. `index()` - Paginated list with relationships loaded (15 per page)
2. `create()` - Form view
3. `store()` - Validation + create + redirect with success message
4. `edit()` - Form view with model
5. `update()` - Validation + update + redirect
6. `destroy()` - Soft delete + redirect

**Bulk Operations** (Pages/Posts): `bulkUpdate()`, `bulkDelete()`, `bulkRestore()`, `bulkPermanentDelete()`

**Soft Deletes:** Pages, Posts, and Menus use soft deletes (`deleted_at` column). Use `SoftDeletes` trait and include trash/bin views.

## Common Development Tasks

```powershell
# Route inspection
C:\xampp\php\php.exe artisan route:list --except-vendor
C:\xampp\php\php.exe artisan route:list --path=admin

# Generate files
C:\xampp\php\php.exe artisan make:model ModelName -m
C:\xampp\php\php.exe artisan make:controller Admin/ControllerName
C:\xampp\php\php.exe artisan make:seeder SeederName
C:\xampp\php\php.exe artisan make:migration create_table_name_table

# Storage and utilities
C:\xampp\php\php.exe artisan storage:link
C:\xampp\php\php.exe artisan tinker
```

## Code Quality

After completing large additions or refactors, ensure code quality:

```powershell
# Run tests
composer test
# Or directly:
C:\xampp\php\php.exe artisan test

# Laravel Pint (code style fixer - PSR-12)
C:\xampp\php\php.exe artisan pint

# Check PHP syntax
C:\xampp\php\php.exe -l path/to/file.php
```

Ensure adherence to PSR-12 coding standards and Laravel best practices.

## Testing Access

After seeding, test these URLs:
- Front-end: `http://127.0.0.1:8000`
- Admin login: `http://127.0.0.1:8000/admin/signin`
- Dashboard: `http://127.0.0.1:8000/admin/dashboard`

## Current Implementation Status

**Completed (~35%):**
- ✅ Database architecture (16 migrations, 26 tables)
- ✅ All 16 Eloquent models with relationships
- ✅ All 16 admin controllers
- ✅ Admin route definitions
- ✅ Seeding system
- ✅ Authentication system

**In Progress:**
- ⏳ Admin UI views (partial implementation)
- ⏳ Front-end views (landing page exists)
- ⏳ Menu builder drag-drop functionality
- ⏳ Media upload interface (dropzone.js)
- ⏳ WYSIWYG editor integration (TinyMCE)

See `docs/REFURBISHMENT_PROGRESS.md` and `docs/IMPLEMENTATION_GUIDE.md` for detailed status.

## Key Files to Know

- `bootstrap/app.php` - Application bootstrap, middleware, route configuration
- `config/auth.php` - Authentication configuration
- `app/Models/User.php` - User model with role/permission methods
- `app/Models/Setting.php` - Settings helper methods
- `database/seeders/DatabaseSeeder.php` - Master seeder
- `routes/admin.php` - All admin routes (350+ lines)

## Development Notes

- **Environment:** Windows PowerShell (use Windows Terminal for best experience)
- **PHP Path:** `C:\xampp\php\php.exe`
- **Working Directory:** `C:\xampp\htdocs\base`
- **Repository:** https://github.com/jorge-correia-software/base-project (private)
- **Previous System:** Multi-tenancy (Stancl/Tenancy) was removed during refurbishment

## Git Commit Guidelines

Follow these guidelines for all commits:

- **Conventional Commits:** Use Conventional Commits formatting for all git commits (e.g., `feat:`, `fix:`, `chore:`, `docs:`)
- **Conventional Branch Naming:** Use prefix-based branch naming (e.g., `feature/`, `bugfix/`, `hotfix/`, `refactor/`)
- **No Claude Attribution:** Do not mention yourself (Claude) as a co-author when committing, or include any links to Claude Code

## CLI Tooling Reminders

- Use the `gh` CLI tool when appropriate to create issues, open pull requests, read comments, etc.
- The `gh` tool is authenticated and available for all GitHub operations
- Leverage `gh` commands for efficient GitHub workflow automation

## Security Notes

- CSRF protection enabled on all forms
- Password hashing: bcrypt with 12 rounds
- Session regeneration on authentication
- SQL injection prevention via Eloquent ORM
- XSS protection via Blade templating `{{ }}` syntax
- **Production Checklist:** Change default passwords, set `APP_DEBUG=false`, enable HTTPS, restrict DB permissions
