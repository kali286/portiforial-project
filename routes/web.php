<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactMessageController;

// ==================== PUBLIC ROUTES (WANAOANGALIA PORTFOLIO) ====================

// Home & About
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Projects
Route::prefix('projects')->name('projects.')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('/category/{category}', [ProjectController::class, 'byCategory'])->name('byCategory');
    Route::get('/{id}', [ProjectController::class, 'show'])->name('show');
});

// Blog
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/category/{category}', [BlogController::class, 'byCategory'])->name('byCategory');
    Route::get('/{id}', [BlogController::class, 'show'])->name('show');
});

// Services
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/{id}', [ServiceController::class, 'show'])->name('show');
});

// Skills
Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');

// Experience
Route::get('/experience', [ExperienceController::class, 'index'])->name('experience.index');

// Education
Route::get('/education', [EducationController::class, 'index'])->name('education.index');

// Testimonials
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');

// Contact
Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactMessageController::class, 'create'])->name('create');
    Route::post('/', [ContactMessageController::class, 'store'])->name('store');
});

// ==================== PUBLIC API ROUTES ====================
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/skills', [SkillController::class, 'apiIndex'])->name('skills.index');
    Route::get('/projects', [ProjectController::class, 'apiIndex'])->name('projects.index');
    Route::get('/testimonials', [TestimonialController::class, 'apiIndex'])->name('testimonials.index');
});

// ==================== FALLBACK ROUTES ====================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});


// ==================== ADMIN ROUTES (WANAOSIMAMIA PORTFOLIO) ====================
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ExperienceController as AdminExperienceController;
use App\Http\Controllers\Admin\EducationController as AdminEducationController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;

// ==================== ADMIN AUTH ROUTES (Public) ====================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
});

// ==================== ADMIN PROTECTED ROUTES ====================
Route::middleware(['admin.auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard & System Management
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/stats', [AdminController::class, 'getStats'])->name('stats');
    
    // Profile Management
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [AdminController::class, 'profile'])->name('index');
        Route::put('/', [AdminController::class, 'updateProfile'])->name('update');
        Route::put('/password', [AdminController::class, 'updatePassword'])->name('password.update');
    });
    
    // System Settings & Tools
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::put('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    Route::get('/activity-logs', [AdminController::class, 'activityLogs'])->name('activity-logs');
    Route::get('/backups', [AdminController::class, 'backups'])->name('backups');
    Route::post('/backups/create', [AdminController::class, 'createBackup'])->name('backups.create');
    Route::get('/system-info', [AdminController::class, 'systemInfo'])->name('system-info');
    Route::post('/clear-cache', [AdminController::class, 'clearCache'])->name('clear-cache');
    Route::post('/optimize', [AdminController::class, 'optimize'])->name('optimize');
    Route::get('/file-manager', [AdminController::class, 'fileManager'])->name('file-manager');
    Route::get('/search', [AdminController::class, 'search'])->name('search');

    // ==================== CONTENT MANAGEMENT ====================

    // Projects Management
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [AdminProjectController::class, 'index'])->name('index');
        Route::get('/create', [AdminProjectController::class, 'create'])->name('create');
        Route::post('/', [AdminProjectController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminProjectController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminProjectController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminProjectController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle-status', [AdminProjectController::class, 'toggleStatus'])->name('toggleStatus');
        Route::post('/{id}/toggle-featured', [AdminProjectController::class, 'toggleFeatured'])->name('toggleFeatured');
    });
    
    // Categories Management
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
        Route::get('/create', [AdminCategoryController::class, 'create'])->name('create');
        Route::post('/', [AdminCategoryController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminCategoryController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminCategoryController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminCategoryController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle-status', [AdminCategoryController::class, 'toggleStatus'])->name('toggleStatus');
    });

    // Skills Management
    Route::prefix('skills')->name('skills.')->group(function () {
        Route::get('/', [AdminSkillController::class, 'index'])->name('index');
        Route::get('/create', [AdminSkillController::class, 'create'])->name('create');
        Route::post('/', [AdminSkillController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminSkillController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminSkillController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminSkillController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle-status', [AdminSkillController::class, 'toggleStatus'])->name('toggleStatus');
        Route::post('/{id}/toggle-featured', [AdminSkillController::class, 'toggleFeatured'])->name('toggleFeatured');
        Route::get('/reorder', [AdminSkillController::class, 'showReorderForm'])->name('reorder');
        Route::post('/reorder', [AdminSkillController::class, 'reorder'])->name('updateOrder');
    });

    // Testimonials Management
    Route::prefix('testimonials')->name('testimonials.')->group(function () {
        Route::get('/', [AdminTestimonialController::class, 'index'])->name('index');
        Route::get('/create', [AdminTestimonialController::class, 'create'])->name('create');
        Route::post('/', [AdminTestimonialController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminTestimonialController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminTestimonialController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminTestimonialController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle-status', [AdminTestimonialController::class, 'toggleStatus'])->name('toggleStatus');
        Route::post('/{id}/approve', [AdminTestimonialController::class, 'approve'])->name('approve');
        Route::post('/{id}/toggle-featured', [AdminTestimonialController::class, 'toggleFeatured'])->name('toggleFeatured');
    });

    // Services Management
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [AdminServiceController::class, 'index'])->name('index');
        Route::get('/create', [AdminServiceController::class, 'create'])->name('create');
        Route::post('/', [AdminServiceController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminServiceController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminServiceController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminServiceController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle-status', [AdminServiceController::class, 'toggleStatus'])->name('toggleStatus');
    });

    // Experience Management
    Route::prefix('experiences')->name('experiences.')->group(function () {
        Route::get('/', [AdminExperienceController::class, 'index'])->name('index');
        Route::get('/create', [AdminExperienceController::class, 'create'])->name('create');
        Route::post('/', [AdminExperienceController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminExperienceController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminExperienceController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminExperienceController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle-status', [AdminExperienceController::class, 'toggleStatus'])->name('toggleStatus');
    });

    // Education Management
    Route::prefix('education')->name('education.')->group(function () {
        Route::get('/', [AdminEducationController::class, 'index'])->name('index');
        Route::get('/create', [AdminEducationController::class, 'create'])->name('create');
        Route::post('/', [AdminEducationController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminEducationController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminEducationController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminEducationController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle-status', [AdminEducationController::class, 'toggleStatus'])->name('toggleStatus');
    });

    // Blog Management
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/', [AdminBlogController::class, 'index'])->name('index');
        Route::get('/create', [AdminBlogController::class, 'create'])->name('create');
        Route::post('/', [AdminBlogController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminBlogController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminBlogController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminBlogController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle-status', [AdminBlogController::class, 'toggleStatus'])->name('toggleStatus');
        Route::post('/{id}/toggle-featured', [AdminBlogController::class, 'toggleFeatured'])->name('toggleFeatured');
    });

    // Contact Messages Management
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [AdminContactMessageController::class, 'index'])->name('index');
        Route::get('/archived', [AdminContactMessageController::class, 'archived'])->name('archived');
        Route::get('/{id}', [AdminContactMessageController::class, 'show'])->name('show');
        Route::delete('/{id}', [AdminContactMessageController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/mark-read', [AdminContactMessageController::class, 'markAsRead'])->name('markRead');
        // Backwards-compatible name expected by views
        Route::post('/{id}/mark-read', [AdminContactMessageController::class, 'markAsRead'])->name('mark-read');
        Route::post('/{id}/mark-unread', [AdminContactMessageController::class, 'markAsUnread'])->name('markUnread');
        Route::post('/{id}/archive', [AdminContactMessageController::class, 'archive'])->name('archive');
        Route::post('/{id}/restore', [AdminContactMessageController::class, 'restore'])->name('restore');
        // Reply notes endpoint used by show view
        Route::post('/{id}/reply', [AdminContactMessageController::class, 'reply'])->name('reply');
        // Mark as replied endpoint expected by show view JS and quick actions
        Route::post('/{id}/mark-replied', [AdminContactMessageController::class, 'markAsReplied'])->name('mark-replied');
        Route::post('/mark-all-read', [AdminContactMessageController::class, 'markAllRead'])->name('mark-all-read');
    });
});