@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-primary mb-2">Dashboard</h1>
        <p class="text-secondary">Welcome back! Here's what's happening with your platform.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Services -->
        <div class="bg-surface border border-border rounded-xl p-6 hover:shadow-lg hover:shadow-primary/5 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-3xl font-bold text-primary">{{ $stats['total_services'] }}</span>
            </div>
            <p class="text-sm text-secondary">Total Services</p>
        </div>

        <!-- Total Portfolios -->
        <div class="bg-surface border border-border rounded-xl p-6 hover:shadow-lg hover:shadow-primary/5 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <span class="text-3xl font-bold text-primary">{{ $stats['total_portfolios'] }}</span>
            </div>
            <p class="text-sm text-secondary">Total Projects</p>
        </div>

        <!-- Published Posts -->
        <div class="bg-surface border border-border rounded-xl p-6 hover:shadow-lg hover:shadow-primary/5 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="text-3xl font-bold text-primary">{{ $stats['published_posts'] }}</span>
            </div>
            <p class="text-sm text-secondary">Published Posts</p>
        </div>

        <!-- Active Jobs -->
        <div class="bg-surface border border-border rounded-xl p-6 hover:shadow-lg hover:shadow-primary/5 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-3xl font-bold text-primary">{{ $stats['active_jobs'] }}</span>
            </div>
            <p class="text-sm text-secondary">Active Job Openings</p>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-surface border border-border rounded-xl p-6">
            <div class="flex items-center justify-between">
                <span class="text-sm text-secondary">Pending Applications</span>
                <span class="text-2xl font-bold text-primary">{{ $stats['pending_applications'] }}</span>
            </div>
        </div>
        
        <div class="bg-surface border border-border rounded-xl p-6">
            <div class="flex items-center justify-between">
                <span class="text-sm text-secondary">Unread Contacts</span>
                <span class="text-2xl font-bold text-primary">{{ $stats['unread_contacts'] }}</span>
            </div>
        </div>

        <div class="bg-surface border border-border rounded-xl p-6">
            <div class="flex items-center justify-between">
                <span class="text-sm text-secondary">Team Members</span>
                <span class="text-2xl font-bold text-primary">{{ $stats['total_team_members'] }}</span>
            </div>
        </div>

        <div class="bg-surface border border-border rounded-xl p-6">
            <div class="flex items-center justify-between">
                <span class="text-sm text-secondary">Approved Testimonials</span>
                <span class="text-2xl font-bold text-primary">{{ $stats['approved_testimonials'] }}</span>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Blog Posts -->
        <div class="bg-surface border border-border rounded-xl p-6">
            <h2 class="text-lg font-bold text-primary mb-4">Recent Blog Posts</h2>
            <div class="space-y-3">
                @forelse($recentPosts as $post)
                    <div class="flex items-center justify-between py-3 border-b border-border last:border-0">
                        <div class="flex-1">
                            <a href="{{ route('admin.blog.posts.edit', $post) }}" class="text-sm font-medium text-primary hover:text-blue-500">
                                {{ Str::limit($post->title, 40) }}
                            </a>
                            <p class="text-xs text-secondary mt-1">{{ $post->category->name }} • {{ $post->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-2 py-1 rounded text-xs {{ $post->is_published ? 'bg-green-900/30 text-green-400' : 'bg-gray-700 text-gray-400' }}">
                            {{ $post->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </div>
                @empty
                    <p class="text-sm text-secondary text-center py-4">No blog posts yet</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Portfolios -->
        <div class="bg-surface border border-border rounded-xl p-6">
            <h2 class="text-lg font-bold text-primary mb-4">Recent Projects</h2>
            <div class="space-y-3">
                @forelse($recentPortfolios as $portfolio)
                    <div class="flex items-center justify-between py-3 border-b border-border last:border-0">
                        <div class="flex-1">
                            <a href="{{ route('admin.portfolio.portfolios.edit', $portfolio) }}" class="text-sm font-medium text-primary hover:text-blue-500">
                                {{ Str::limit($portfolio->title, 40) }}
                            </a>
                            <p class="text-xs text-secondary mt-1">{{ $portfolio->category->name }} • {{ $portfolio->project_date ? \Carbon\Carbon::parse($portfolio->project_date)->format('M Y') : 'No date' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-secondary text-center py-4">No projects yet</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Applications -->
        <div class="bg-surface border border-border rounded-xl p-6">
            <h2 class="text-lg font-bold text-primary mb-4">Recent Applications</h2>
            <div class="space-y-3">
                @forelse($recentApplications as $application)
                    <div class="flex items-center justify-between py-3 border-b border-border last:border-0">
                        <div class="flex-1">
                            <a href="{{ route('admin.career.applications.show', $application) }}" class="text-sm font-medium text-primary hover:text-blue-500">
                                {{ $application->full_name }}
                            </a>
                            <p class="text-xs text-secondary mt-1">{{ Str::limit($application->job->title, 30) }} • {{ $application->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-2 py-1 rounded text-xs {{ $application->status === 'pending' ? 'bg-yellow-900/30 text-yellow-400' : 'bg-blue-900/30 text-blue-400' }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-sm text-secondary text-center py-4">No applications yet</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Contacts -->
        <div class="bg-surface border border-border rounded-xl p-6">
            <h2 class="text-lg font-bold text-primary mb-4">Recent Contacts</h2>
            <div class="space-y-3">
                @forelse($recentContacts as $contact)
                    <div class="flex items-center justify-between py-3 border-b border-border last:border-0">
                        <div class="flex-1">
                            <a href="{{ route('admin.contact.submissions.show', $contact) }}" class="text-sm font-medium text-primary hover:text-blue-500">
                                {{ $contact->name }}
                            </a>
                            <p class="text-xs text-secondary mt-1">{{ Str::limit($contact->subject, 30) }} • {{ $contact->created_at->diffForHumans() }}</p>
                        </div>
                        @if(!$contact->is_read)
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-secondary text-center py-4">No contacts yet</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
