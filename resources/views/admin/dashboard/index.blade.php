@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Users -->
    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-indigo-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Users</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_users'] }}</h3>
            </div>
            <div class="bg-indigo-100 p-3 rounded-lg">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Services -->
    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Services</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_services'] }}</h3>
            </div>
            <div class="bg-green-100 p-3 rounded-lg">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Portfolios -->
    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
        <div>
            <p class="text-gray-500 text-sm font-medium">Portfolios</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_portfolios'] }}</h3>
        </div>
    </div>

    <!-- Total Blog Posts -->
    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
        <div>
            <p class="text-gray-500 text-sm font-medium">Blog Posts</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_blog_posts'] }}</h3>
        </div>
    </div>

    <!-- Total Jobs -->
    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500">
        <div>
            <p class="text-gray-500 text-sm font-medium">Job Openings</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_jobs'] }}</h3>
        </div>
    </div>

    <!-- Pending Applications -->
    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-orange-500">
        <div>
            <p class="text-gray-500 text-sm font-medium">Pending Applications</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['pending_applications'] }}</h3>
        </div>
    </div>

    <!-- Unread Contacts -->
    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-red-500">
        <div>
            <p class="text-gray-500 text-sm font-medium">Unread Contacts</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['unread_contacts'] }}</h3>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Job Applications -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Job Applications</h3>
        <div class="space-y-4">
            @forelse ($recent_applications as $application)
                <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                    <div>
                        <p class="font-medium text-gray-800">{{ $application->full_name }}</p>
                        <p class="text-sm text-gray-500">{{ $application->job->title ?? 'N/A' }}</p>
                    </div>
                    <span class="px-3 py-1 text-xs font-medium rounded-full 
                        @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($application->status === 'accepted') bg-green-100 text-green-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>
            @empty
                <p class="text-gray-500 text-sm">No recent applications</p>
            @endforelse
        </div>
    </div>

    <!-- Recent Contact Submissions -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Contact Messages</h3>
        <div class="space-y-4">
            @forelse ($recent_contacts as $contact)
                <div class="py-3 border-b border-gray-100 last:border-0">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">{{ $contact->name }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($contact->message, 60) }}</p>
                        </div>
                        @if(!$contact->read_at)
                            <span class="ml-2 w-2 h-2 bg-blue-500 rounded-full"></span>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-sm">No recent messages</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
