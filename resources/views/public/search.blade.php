@extends('layouts.public')

@section('title', 'Search Results')

@section('content')
    <!-- Search Header -->
    <section class="pt-24 pb-12 bg-surface border-b border-border">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-primary mb-6">Search</h1>
            
            <!-- Search Form -->
            <form action="{{ route('search') }}" method="GET" class="max-w-2xl">
                <div class="flex gap-2">
                    <input type="text" name="q" value="{{ $query }}" placeholder="Search blog, portfolio, services..." required class="flex-1 px-6 py-4 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                    <button type="submit" class="px-8 py-4 bg-primary text-background rounded-lg font-medium hover:opacity-90 transition-opacity">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Results -->
    <section class="py-12">
        <div class="container mx-auto px-4 max-w-4xl">
            @if($query)
                <p class="text-secondary mb-8">
                    Found <span class="font-bold text-primary">{{ $totalResults }}</span> results for "<span class="font-bold text-primary">{{ $query }}</span>"
                </p>

                @if($results->count() > 0)
                    <div class="space-y-6">
                        @foreach($results as $result)
                            <article class="p-6 bg-surface border border-border rounded-xl hover:shadow-lg hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                                <!-- Type Badge -->
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="px-2 py-1 rounded text-xs font-bold 
                                        {{ $result['type'] === 'blog' ? 'bg-blue-900/30 text-blue-400' : '' }}
                                        {{ $result['type'] === 'portfolio' ? 'bg-purple-900/30 text-purple-400' : '' }}
                                        {{ $result['type'] === 'service' ? 'bg-green-900/30 text-green-400' : '' }}
                                    ">
                                        {{ ucfirst($result['type']) }}
                                    </span>
                                    <span class="text-xs text-secondary">{{ $result['category'] }}</span>
                                </div>

                                <!-- Title -->
                                <h2 class="text-xl font-bold text-primary mb-2 hover:text-blue-500 transition-colors">
                                    <a href="{{ $result['url'] }}">{{ $result['title'] }}</a>
                                </h2>

                                <!-- Excerpt -->
                                <p class="text-secondary text-sm mb-4">
                                    {{ $result['excerpt'] }}
                                </p>

                                <!-- Link -->
                                <a href="{{ $result['url'] }}" class="text-sm font-medium text-primary hover:underline inline-flex items-center gap-1">
                                    View Details
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto mb-4 text-secondary opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <p class="text-secondary mb-2">No results found</p>
                        <p class="text-sm text-secondary">Try different keywords or check your spelling</p>
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto mb-4 text-secondary opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <p class="text-secondary">Enter a search term to get started</p>
                </div>
            @endif
        </div>
    </section>
@endsection
