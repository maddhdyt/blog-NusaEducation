<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use App\Http\Controllers\Frontend\PostController as FrontendPostController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\GalleryController as FrontendGalleryController;
use App\Http\Controllers\Frontend\SubscriptionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SidebarSettingController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', HomeController::class)->name('home');
Route::get('/page/{page:slug}', [FrontendPageController::class, 'show'])->name('pages.show');
Route::get('/blog', [FrontendPostController::class, 'index'])->name('posts.index');
Route::get('/search', [FrontendPostController::class, 'search'])->name('posts.search');
Route::get('/blog/{post:slug}', [FrontendPostController::class, 'show'])->name('posts.show');
Route::get('/category/{category:slug}', [FrontendCategoryController::class, 'show'])->name('categories.show');
Route::get('/gallery', [FrontendGalleryController::class, 'index'])->name('gallery.index');
Route::post('/subscribe', [SubscriptionController::class, 'store'])->middleware('throttle:5,1')->name('newsletter.subscribe');
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index']);
// Auth Routes
require __DIR__.'/auth.php';

// Dashboard redirect - Laravel Breeze compatibility
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

// Admin Routes - Protected by auth and role:admin middleware
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Menu Management
    Route::resource('menus', MenuController::class);
    
    // Page Management
    Route::resource('pages', PageController::class)->except(['show']);
    
    // Category Management
    Route::resource('categories', CategoryController::class)->except(['show']);
    
    // Post Management
    Route::post('posts/upload-image', [PostController::class, 'uploadImage'])->name('posts.upload_image');
    Route::resource('posts', PostController::class)->except(['show']);

    // Gallery Management
    Route::resource('galleries', GalleryController::class)->except(['show']);

    // Subscribers
    Route::resource('subscribers', SubscriberController::class)->only(['index', 'destroy']);

    // Users
    Route::resource('users', UserController::class)->except(['show']);

    // Sidebar Settings
    Route::get('sidebar-settings', [SidebarSettingController::class, 'edit'])->name('sidebar-settings.edit');
    Route::put('sidebar-settings', [SidebarSettingController::class, 'update'])->name('sidebar-settings.update');
    
    // Profile Management (Optional)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
