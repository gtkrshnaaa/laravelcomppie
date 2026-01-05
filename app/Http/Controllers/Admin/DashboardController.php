<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{User, Service, Portfolio, BlogPost, Job, JobApplication, ContactSubmission};

class DashboardController extends Controller
{
    /**
     * Display admin dashboard with statistics
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_services' => Service::count(),
            'total_portfolios' => Portfolio::count(),
            'total_blog_posts' => BlogPost::count(),
            'total_jobs' => Job::count(),
            'pending_applications' => JobApplication::where('status', 'pending')->count(),
            'unread_contacts' => ContactSubmission::whereNull('read_at')->count(),
        ];

        $recent_applications = JobApplication::with('job')
            ->latest()
            ->limit(5)
            ->get();

        $recent_contacts = ContactSubmission::latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'recent_applications', 'recent_contacts'));
    }
}
