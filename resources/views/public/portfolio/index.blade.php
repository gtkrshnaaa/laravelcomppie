@extends('layouts.public')

@section('title', 'Portfolio')

@section('content')
    <!-- Page Header -->
    <section class="pt-24 pb-12 bg-background">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-6xl font-bold text-primary mb-4">Our Portfolio</h1>
            <p class="text-secondary text-lg max-w-2xl">Showcasing our best work and successful projects</p>
        </div>
    </section>

    <!-- Category Filter -->
    <section class="py-8 border-b border-border bg-surface">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap gap-2 justify-center">
                <a href="{{ route('portfolio.index') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ !request('category') ? 'bg-primary text-background' : 'bg-background text-secondary hover:text-primary' }} border border-border transition-colors">
                    All Projects
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('portfolio.index', ['category' => $category->slug]) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('category') === $category->slug ? 'bg-primary text-background' : 'bg-background text-secondary hover:text-primary' }} border border-border transition-colors">
                        {{ $category->name }} ({{ $category->portfolios_count }})
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Portfolio Grid -->
    <section class="py-20 bg-background">
        <div class="container mx-auto px-4">
            @if($portfolios->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($portfolios as $portfolio)
                        <article class="group bg-surface border border-border rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                            <!-- Project Image -->
                            <div class="aspect-[4/3] bg-background/50 overflow-hidden">
                                @if($portfolio->image)
                                    <img src="{{ Storage::url($portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 opacity-30">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 8.67v7.568a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V8.67a2.25 2.25 0 00-2.25-2.592m0 0V6a2.25 2.25 0 00-2.25-2.25h-7.5A2.25 2.25 0 006 6v.878"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <!-- Category -->
                                <span class="px-2 py-1 rounded text-xs font-bold bg-primary/10 text-primary">
                                    {{ $portfolio->category->name }}
                                </span>

                                <!-- Title -->
                                <h3 class="text-xl font-bold text-primary mt-3 mb-2 group-hover:text-blue-500 transition-colors">
                                    <a href="{{ route('portfolio.show', $portfolio->slug) }}">{{ $portfolio->title }}</a>
                                </h3>

                                <!-- Client -->
                                @if($portfolio->client_company)
                                    <p class="text-secondary text-sm mb-3">
                                        Client: <span class="font-medium">{{ $portfolio->client_company }}</span>
                                    </p>
                                @endif

                                <!-- Description -->
                                <p class="text-secondary text-sm line-clamp-2 mb-4">
                                    {{ Str::limit(strip_tags($portfolio->description), 100) }}
                                </p>

                                <!-- View Project -->
                                <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="text-sm font-bold text-primary hover:underline flex items-center gap-1">
                                    View Project
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                        <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $portfolios->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="text-secondary mb-4">
                        <svg class="w-16 h-16 mx-auto opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <p class="text-primary text-lg font-medium mb-2">No projects found</p>
                    <p class="text-secondary">Try selecting a different category</p>
                </div>
            @endif
        </div>
    </section>
@endsection
