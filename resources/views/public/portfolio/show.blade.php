@extends('layouts.public')

@section('title', $portfolio->title . ' - Portfolio')

@section('content')
    <!-- Project Header -->
    <section class="pt-24 pb-12">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Category -->
            <a href="{{ route('portfolio.index', ['category' => $portfolio->category->slug]) }}" class="inline-block px-3 py-1 rounded-full text-sm font-bold bg-primary/10 text-primary hover:bg-primary/20 transition-colors mb-6">
                {{ $portfolio->category->name }}
            </a>

            <!-- Title -->
            <h1 class="text-4xl md:text-6xl font-bold text-primary mb-6 leading-tight">
                {{ $portfolio->title }}
            </h1>

            <!-- Project Info -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 pb-8 border-b border-border">
                @if($portfolio->client_company)
                    <div>
                        <p class="text-secondary text-sm mb-1">Client</p>
                        <p class="text-primary font-medium">{{ $portfolio->client_company }}</p>
                    </div>
                @endif
                @if($portfolio->project_date)
                    <div>
                        <p class="text-secondary text-sm mb-1">Date</p>
                        <p class="text-primary font-medium">{{ \Carbon\Carbon::parse($portfolio->project_date)->format('M Y') }}</p>
                    </div>
                @endif
                @if($portfolio->category)
                    <div>
                        <p class="text-secondary text-sm mb-1">Category</p>
                        <p class="text-primary font-medium">{{ $portfolio->category->name }}</p>
                    </div>
                @endif
                @if($portfolio->project_url)
                    <div>
                        <p class="text-secondary text-sm mb-1">Website</p>
                        <a href="{{ $portfolio->project_url }}" target="_blank" class="text-primary font-medium hover:underline flex items-center gap-1">
                            Visit Site
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Featured Image -->
    @if($portfolio->image)
        <section class="pb-12">
            <div class="container mx-auto px-4 max-w-6xl">
                <div class="aspect-[16/9] rounded-2xl overflow-hidden bg-background">
                    <img src="{{ Storage::url($portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                </div>
            </div>
        </section>
    @endif

    <!-- Project Description -->
    <section class="pb-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="prose prose-lg dark:prose-invert max-w-none">
                <div class="text-primary leading-relaxed">
                    {!! nl2br(e($portfolio->description)) !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Technologies -->
    @if($portfolio->technologies && count($portfolio->technologies) > 0)
        <section class="pb-12 border-b border-border">
            <div class="container mx-auto px-4 max-w-4xl">
                <h3 class="text-xl font-bold text-primary mb-4">Technologies Used</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($portfolio->technologies as $tech)
                        <span class="px-3 py-1 rounded-full text-sm bg-surface text-primary border border-border">
                            {{ $tech }}
                        </span>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Gallery -->
    @if($portfolio->gallery_images && count($portfolio->gallery_images) > 0)
        <section class="py-12 bg-surface">
            <div class="container mx-auto px-4 max-w-6xl">
                <h3 class="text-2xl font-bold text-primary mb-8">Project Gallery</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($portfolio->gallery_images as $image)
                        <div class="aspect-[4/3] rounded-xl overflow-hidden bg-background">
                            <img src="{{ Storage::url($image) }}" alt="Gallery image" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Related Projects -->
    @if($relatedPortfolios->count() > 0)
        <section class="py-20 bg-background">
            <div class="container mx-auto px-4 max-w-6xl">
                <h2 class="text-3xl font-bold text-primary mb-8">Related Projects</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedPortfolios as $related)
                        <article class="group bg-surface border border-border rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                            <div class="aspect-[4/3] bg-background/50 overflow-hidden">
                                @if($related->image)
                                    <img src="{{ Storage::url($related->image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-primary group-hover:text-blue-500 transition-colors">
                                    <a href="{{ route('portfolio.show', $related->slug) }}">{{ $related->title }}</a>
                                </h3>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Back to Portfolio -->
    <section class="py-12">
        <div class="container mx-auto px-4 max-w-6xl">
            <a href="{{ route('portfolio.index') }}" class="inline-flex items-center gap-2 text-secondary hover:text-primary transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Portfolio
            </a>
        </div>
    </section>
@endsection
