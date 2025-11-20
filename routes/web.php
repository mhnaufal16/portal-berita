<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirect dashboard biasa ke admin dashboard
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class)
         ->parameters(['pages' => 'post'])
         ->except(['create', 'store']);
    
    Route::post('/pages/{post}/publish', [\App\Http\Controllers\Admin\PageController::class, 'quickPublish'])
        ->name('pages.quick-publish');
    Route::post('/pages/{post}/unpublish', [\App\Http\Controllers\Admin\PageController::class, 'quickUnpublish'])
        ->name('pages.quick-unpublish');
});

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/profile-perusahaan', [PageController::class, 'showProfile'])->name('pages.profile');

// Admin Routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $postCount = \App\Models\Post::count();
        $categoryCount = \App\Models\Category::count();
        $pageCount = \App\Models\Post::where('slug', 'profile-perusahaan')->count();
        $todayPostCount = \App\Models\Post::whereDate('created_at', today())->count();
        $recentPosts = \App\Models\Post::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'postCount', 
            'categoryCount', 
            'pageCount', 
            'todayPostCount',
            'recentPosts'
        ));
    })->name('admin.dashboard');
    
    Route::resource('posts', AdminPostController::class)->names('admin.posts');
    Route::resource('categories', AdminCategoryController::class)->names('admin.categories');
    Route::resource('pages', AdminPageController::class)->names('admin.pages')->except(['create', 'store']);
});

// Breeze Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';