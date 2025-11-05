<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\SupportAreaController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\ContactSubmissionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| These routes are for the admin panel. All routes are prefixed with /admin
| and require authentication.
|
*/

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard (only accessible at /admin/dashboard, not /admin)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pages Management
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/', [PageController::class, 'index'])->name('index');
        Route::get('/create', [PageController::class, 'create'])->name('create');
        Route::post('/', [PageController::class, 'store'])->name('store');
        Route::post('/bulk-update', [PageController::class, 'bulkUpdate'])->name('bulk-update');
        Route::post('/check-deletable', [PageController::class, 'checkDeletable'])->name('check-deletable');
        Route::post('/bulk-delete', [PageController::class, 'bulkDelete'])->name('bulk-delete');
        Route::post('/bulk-restore', [PageController::class, 'bulkRestore'])->name('bulk-restore');
        Route::post('/bulk-permanent-delete', [PageController::class, 'bulkPermanentDelete'])->name('bulk-permanent-delete');
        Route::get('/bin', [PageController::class, 'bin'])->name('bin');
        Route::get('/{page}/edit', [PageController::class, 'edit'])->name('edit');
        Route::put('/{page}', [PageController::class, 'update'])->name('update');
        Route::delete('/{page}', [PageController::class, 'destroy'])->name('destroy');
    });

    // Posts/News Management
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::post('/bulk-update', [PostController::class, 'bulkUpdate'])->name('bulk-update');
        Route::post('/check-deletable', [PostController::class, 'checkDeletable'])->name('check-deletable');
        Route::post('/bulk-delete', [PostController::class, 'bulkDelete'])->name('bulk-delete');
        Route::post('/bulk-restore', [PostController::class, 'bulkRestore'])->name('bulk-restore');
        Route::post('/bulk-permanent-delete', [PostController::class, 'bulkPermanentDelete'])->name('bulk-permanent-delete');
        Route::get('/bin', [PostController::class, 'bin'])->name('bin');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
    });

    // Categories Management
    Route::resource('categories', CategoryController::class);
    Route::post('categories/bulk-update', [CategoryController::class, 'bulkUpdate'])->name('categories.bulk-update');
    Route::post('categories/check-deletable', [CategoryController::class, 'checkDeletable'])->name('categories.check-deletable');
    Route::post('categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulk-delete');

    // Tags Management
    Route::resource('tags', TagController::class);
    Route::post('tags/bulk-update', [TagController::class, 'bulkUpdate'])->name('tags.bulk-update');
    Route::post('tags/check-deletable', [TagController::class, 'checkDeletable'])->name('tags.check-deletable');
    Route::post('tags/bulk-delete', [TagController::class, 'bulkDelete'])->name('tags.bulk-delete');

    // Media Library
    Route::resource('media', MediaController::class);
    Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::post('media/bulk-update', [MediaController::class, 'bulkUpdate'])->name('media.bulk-update');
    Route::post('media/check-deletable', [MediaController::class, 'checkDeletable'])->name('media.check-deletable');
    Route::delete('media/bulk-delete', [MediaController::class, 'bulkDelete'])->name('media.bulk-delete');

    // Menu Management
    Route::prefix('menus')->name('menus.')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('index');
        Route::get('/create', [MenuController::class, 'create'])->name('create');
        Route::post('/', [MenuController::class, 'store'])->name('store');
        Route::post('/bulk-update', [MenuController::class, 'bulkUpdate'])->name('bulk-update');
        Route::post('/check-deletable', [MenuController::class, 'checkDeletable'])->name('check-deletable');
        Route::post('/bulk-delete', [MenuController::class, 'bulkDelete'])->name('bulk-delete');
        Route::post('/bulk-restore', [MenuController::class, 'bulkRestore'])->name('bulk-restore');
        Route::post('/bulk-permanent-delete', [MenuController::class, 'bulkPermanentDelete'])->name('bulk-permanent-delete');
        Route::get('/bin', [MenuController::class, 'bin'])->name('bin');
        Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('edit');
        Route::put('/{menu}', [MenuController::class, 'update'])->name('update');
        Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('destroy');
        Route::post('/{menu}/items', [MenuController::class, 'addItem'])->name('items.store');
        Route::put('/items/{menuItem}', [MenuController::class, 'updateItem'])->name('items.update');
        Route::delete('/items/{menuItem}', [MenuController::class, 'deleteItem'])->name('items.destroy');
        Route::post('/{menu}/add-pages', [MenuController::class, 'addPagesToMenu'])->name('items.add-pages');
        Route::post('/{menu}/structure', [MenuController::class, 'updateMenuStructure'])->name('structure.update');
        Route::post('/{menu}/reorder', [MenuController::class, 'reorderItems'])->name('reorder');
    });

    // Users Management
    Route::resource('users', UserController::class);
    Route::post('users/bulk-update', [UserController::class, 'bulkUpdate'])->name('users.bulk-update');
    Route::post('users/check-deletable', [UserController::class, 'checkDeletable'])->name('users.check-deletable');
    Route::post('users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulk-delete');

    // Roles Management
    Route::resource('roles', RoleController::class);
    Route::post('roles/bulk-update', [RoleController::class, 'bulkUpdate'])->name('roles.bulk-update');
    Route::post('roles/check-deletable', [RoleController::class, 'checkDeletable'])->name('roles.check-deletable');
    Route::post('roles/bulk-delete', [RoleController::class, 'bulkDelete'])->name('roles.bulk-delete');

    // Programs Management
    Route::resource('programs', ProgramController::class);
    Route::post('programs/reorder', [ProgramController::class, 'reorder'])->name('programs.reorder');
    Route::post('programs/bulk-update', [ProgramController::class, 'bulkUpdate'])->name('programs.bulk-update');
    Route::post('programs/check-deletable', [ProgramController::class, 'checkDeletable'])->name('programs.check-deletable');
    Route::post('programs/bulk-delete', [ProgramController::class, 'bulkDelete'])->name('programs.bulk-delete');

    // Support Areas Management
    Route::resource('support-areas', SupportAreaController::class);
    Route::post('support-areas/reorder', [SupportAreaController::class, 'reorder'])->name('support-areas.reorder');
    Route::post('support-areas/bulk-update', [SupportAreaController::class, 'bulkUpdate'])->name('support-areas.bulk-update');
    Route::post('support-areas/check-deletable', [SupportAreaController::class, 'checkDeletable'])->name('support-areas.check-deletable');
    Route::post('support-areas/bulk-delete', [SupportAreaController::class, 'bulkDelete'])->name('support-areas.bulk-delete');

    // Testimonials Management
    Route::resource('testimonials', TestimonialController::class);
    Route::post('testimonials/reorder', [TestimonialController::class, 'reorder'])->name('testimonials.reorder');
    Route::post('testimonials/bulk-update', [TestimonialController::class, 'bulkUpdate'])->name('testimonials.bulk-update');
    Route::post('testimonials/check-deletable', [TestimonialController::class, 'checkDeletable'])->name('testimonials.check-deletable');
    Route::post('testimonials/bulk-delete', [TestimonialController::class, 'bulkDelete'])->name('testimonials.bulk-delete');

    // Hero Sections Management
    Route::resource('hero-sections', HeroSectionController::class);
    Route::post('hero-sections/reorder', [HeroSectionController::class, 'reorder'])->name('hero-sections.reorder');
    Route::post('hero-sections/bulk-update', [HeroSectionController::class, 'bulkUpdate'])->name('hero-sections.bulk-update');
    Route::post('hero-sections/check-deletable', [HeroSectionController::class, 'checkDeletable'])->name('hero-sections.check-deletable');
    Route::post('hero-sections/bulk-delete', [HeroSectionController::class, 'bulkDelete'])->name('hero-sections.bulk-delete');

    // Contact Submissions
    Route::get('contact-submissions', [ContactSubmissionController::class, 'index'])->name('contact-submissions.index');
    Route::get('contact-submissions/{submission}', [ContactSubmissionController::class, 'show'])->name('contact-submissions.show');
    Route::post('contact-submissions/{submission}/mark-read', [ContactSubmissionController::class, 'markAsRead'])->name('contact-submissions.mark-read');
    Route::post('contact-submissions/{submission}/mark-replied', [ContactSubmissionController::class, 'markAsReplied'])->name('contact-submissions.mark-replied');
    Route::delete('contact-submissions/{submission}', [ContactSubmissionController::class, 'destroy'])->name('contact-submissions.destroy');
    Route::post('contact-submissions/bulk-update', [ContactSubmissionController::class, 'bulkUpdate'])->name('contact-submissions.bulk-update');
    Route::post('contact-submissions/check-deletable', [ContactSubmissionController::class, 'checkDeletable'])->name('contact-submissions.check-deletable');
    Route::post('contact-submissions/bulk-delete', [ContactSubmissionController::class, 'bulkDelete'])->name('contact-submissions.bulk-delete');

    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('settings/{group}', [SettingController::class, 'group'])->name('settings.group');
});
