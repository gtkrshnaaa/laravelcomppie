@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-primary mb-2">Control Center</h2>
        <p class="text-secondary">Overview of your platform's performance.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Services Widget -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl group-hover:bg-blue-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Total Services</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $stats['total_services'] }}</p>
                <span class="text-xs text-blue-400 mb-1">Items</span>
            </div>
        </div>

        <!-- Total Portfolios Widget -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Portfolios</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $stats['total_portfolios'] }}</p>
                <span class="text-xs text-purple-400 mb-1">Projects</span>
            </div>
        </div>

        <!-- Total Blog Posts Widget -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-500/10 rounded-full blur-2xl group-hover:bg-green-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Blog Posts</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $stats['total_blog_posts'] }}</p>
                <span class="text-xs text-green-400 mb-1">Articles</span>
            </div>
        </div>

        <!-- Pending Applications Widget -->
        <div class="bg-surface border border-border p-6 rounded-xl relative overflow-hidden group hover:border-primary/20 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-500/10 rounded-full blur-2xl group-hover:bg-red-500/20 transition-colors"></div>
            <h3 class="text-secondary text-xs uppercase tracking-widest font-bold mb-2">Pending Apps</h3>
            <div class="flex items-end gap-2">
                <p class="text-4xl font-bold text-primary font-mono">{{ $stats['pending_applications'] }}</p>
                <span class="text-xs text-red-400 mb-1">Waiting</span>
            </div>
        </div>
    </div>

    <!-- Recent Data Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Recent Job Applications -->
        <div class="bg-surface border border-border rounded-xl overflow-hidden shadow-sm">
            <div class="p-6 border-b border-border">
                <h3 class="text-primary font-bold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Recent Job Applications
                </h3>
            </div>
            <div class="divide-y divide-border">
                @forelse ($recent_applications as $application)
                    <div class="p-4 hover:bg-primary/5 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-primary">{{ $application->full_name }}</p>
                                <p class="text-xs text-secondary mt-1">{{ $application->job->title ?? 'N/A' }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs font-medium rounded-full 
                                @if($application->status === 'pending') bg-yellow-500/20 text-yellow-400
                                @elseif($application->status === 'accepted') bg-green-500/20 text-green-400
                                @else bg-gray-500/20 text-gray-400
                                @endif">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-secondary text-sm">
                        No recent applications
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Contact Submissions -->
        <div class="bg-surface border border-border rounded-xl overflow-hidden shadow-sm">
            <div class="p-6 border-b border-border">
                <h3 class="text-primary font-bold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Recent Contact Messages
                </h3>
            </div>
            <div class="divide-y divide-border">
                @forelse ($recent_contacts as $contact)
                    <div class="p-4 hover:bg-primary/5 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm font-medium text-primary">{{ $contact->name }}</p>
                                    @if(!$contact->read_at)
                                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                    @endif
                                </div>
                                <p class="text-xs text-secondary mt-1">{{ Str::limit($contact->message, 50) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-secondary text-sm">
                        No recent messages
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
