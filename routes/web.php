<?php

use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Blog
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Public\BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [\App\Http\Controllers\Public\BlogController::class, 'show'])->name('show');
});

// Portfolio
Route::prefix('portfolio')->name('portfolio.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Public\PortfolioController::class, 'index'])->name('index');
    Route::get('/{slug}', [\App\Http\Controllers\Public\PortfolioController::class, 'show'])->name('show');
});

// Services
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Public\ServiceController::class, 'index'])->name('index');
    Route::get('/{slug}', [\App\Http\Controllers\Public\ServiceController::class, 'show'])->name('show');
});

// About
Route::get('/about', [\App\Http\Controllers\Public\AboutController::class, 'index'])->name('about');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Login routes (guest only)
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.post');
    
    // Protected admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
        
        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/company', [\App\Http\Controllers\Admin\Settings\CompanyController::class, 'index'])->name('company.index');
            Route::put('/company', [\App\Http\Controllers\Admin\Settings\CompanyController::class, 'update'])->name('company.update');
        });
        
        // Service Management
        Route::prefix('service')->name('service.')->group(function () {
            Route::resource('services', \App\Http\Controllers\Admin\Service\ServiceController::class);
            Route::resource('categories', \App\Http\Controllers\Admin\Service\CategoryController::class);
        });
        
        // Portfolio Management
        Route::prefix('portfolio')->name('portfolio.')->group(function () {
            Route::resource('portfolios', \App\Http\Controllers\Admin\Portfolio\PortfolioController::class);
            Route::resource('categories', \App\Http\Controllers\Admin\Portfolio\CategoryController::class);
        });
        
        // Blog Management
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::resource('posts', \App\Http\Controllers\Admin\Blog\PostController::class);
            Route::resource('categories', \App\Http\Controllers\Admin\Blog\CategoryController::class);
            Route::resource('tags', \App\Http\Controllers\Admin\Blog\TagController::class);
        });
        
        // Career Management
        Route::prefix('career')->name('career.')->group(function () {
            Route::resource('jobs', \App\Http\Controllers\Admin\Career\JobController::class);
            Route::get('/applications', [\App\Http\Controllers\Admin\Career\ApplicationController::class, 'index'])->name('applications.index');
            Route::get('/applications/{application}', [\App\Http\Controllers\Admin\Career\ApplicationController::class, 'show'])->name('applications.show');
            Route::put('/applications/{application}/status', [\App\Http\Controllers\Admin\Career\ApplicationController::class, 'updateStatus'])->name('applications.update-status');
            Route::get('/applications/{application}/resume', [\App\Http\Controllers\Admin\Career\ApplicationController::class, 'downloadResume'])->name('applications.download-resume');
            Route::delete('/applications/{application}', [\App\Http\Controllers\Admin\Career\ApplicationController::class, 'destroy'])->name('applications.destroy');
        });
        
        // Team Management
        Route::prefix('team')->name('team.')->group(function () {
            Route::resource('members', \App\Http\Controllers\Admin\Team\MemberController::class);
        });
        
        // Testimonial Management
        Route::prefix('testimonial')->name('testimonial.')->group(function () {
            Route::resource('testimonials', \App\Http\Controllers\Admin\Testimonial\TestimonialController::class);
        });
        
        // FAQ Management
        Route::prefix('faq')->name('faq.')->group(function () {
            Route::resource('faqs', \App\Http\Controllers\Admin\Faq\FaqController::class);
            Route::resource('categories', \App\Http\Controllers\Admin\Faq\CategoryController::class);
        });
        
        // Contact Submissions
        Route::prefix('contact')->name('contact.')->group(function () {
            Route::get('/submissions', [\App\Http\Controllers\Admin\Contact\SubmissionController::class, 'index'])->name('submissions.index');
            Route::get('/submissions/{submission}', [\App\Http\Controllers\Admin\Contact\SubmissionController::class, 'show'])->name('submissions.show');
            Route::delete('/submissions/{submission}', [\App\Http\Controllers\Admin\Contact\SubmissionController::class, 'destroy'])->name('submissions.destroy');
            Route::put('/submissions/{submission}/read', [\App\Http\Controllers\Admin\Contact\SubmissionController::class, 'markAsRead'])->name('submissions.mark-read');
            Route::put('/submissions/{submission}/unread', [\App\Http\Controllers\Admin\Contact\SubmissionController::class, 'markAsUnread'])->name('submissions.mark-unread');
        });
        
        // Slider Management
        Route::prefix('slider')->name('slider.')->group(function () {
            Route::resource('sliders', \App\Http\Controllers\Admin\Slider\SliderController::class);
        });
        
        // User Management
        Route::prefix('user')->name('user.')->group(function () {
            Route::resource('users', \App\Http\Controllers\Admin\User\UserController::class);
        });
    });
});
