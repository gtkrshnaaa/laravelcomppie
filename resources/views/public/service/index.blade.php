@extends('layouts.public')

@section('title', 'Our Services')

@section('content')
    <!-- Page Header -->
    <section class="pt-24 pb-12 bg-background">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-6xl font-bold text-primary mb-4">Our Services</h1>
            <p class="text-secondary text-lg max-w-2xl">Professional solutions tailored to your business needs</p>
        </div>
    </section>

    <!-- Category Filter -->
    <section class="py-8 border-b border-border bg-surface">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap gap-2 justify-center">
                <a href="{{ route('services.index') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ !request('category') ? 'bg-primary text-background' : 'bg-background text-secondary hover:text-primary' }} border border-border transition-colors">
                    All Services
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('services.index', ['category' => $category->slug]) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('category') === $category->slug ? 'bg-primary text-background' : 'bg-background text-secondary hover:text-primary' }} border border-border transition-colors">
                        {{ $category->name }} ({{ $category->services_count }})
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-20 bg-background">
        <div class="container mx-auto px-4">
            @if($services->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($services as $service)
                        <article class="group bg-surface border border-border rounded-2xl p-8 hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                            <!-- Icon -->
                            @if($service->icon)
                                <div class="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                    <span class="text-3xl">{{ $service->icon }}</span>
                                </div>
                            @elseif($service->image)
                                <div class="aspect-[16/10] rounded-xl overflow-hidden mb-6">
                                    <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-cover">
                                </div>
                            @endif

                            <!-- Category -->
                            <span class="px-2 py-1 rounded text-xs font-bold bg-primary/10 text-primary">
                                {{ $service->category->name }}
                            </span>

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-primary mt-3 mb-2 group-hover:text-blue-500 transition-colors">
                                <a href="{{ route('services.show', $service->slug) }}">{{ $service->name }}</a>
                            </h3>

                            <!-- Short Description -->
                            <p class="text-secondary text-sm mb-4 line-clamp-3">
                                {{ $service->short_description ?? Str::limit(strip_tags($service->description), 120) }}
                            </p>

                            <!-- Price -->
                            @if($service->price_starting_from)
                                <p class="text-primary font-bold mb-4">
                                    Starting from ${{ number_format($service->price_starting_from, 2) }}
                                </p>
                            @endif

                            <!-- Learn More -->
                            <a href="{{ route('services.show', $service->slug) }}" class="text-sm font-bold text-primary hover:underline flex items-center gap-1">
                                Learn More
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd"/>
                                </svg>
                            </a>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $services->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="text-secondary mb-4">
                        <svg class="w-16 h-16 mx-auto opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-primary text-lg font-medium mb-2">No services found</p>
                    <p class="text-secondary">Try selecting a different category</p>
                </div>
            @endif
        </div>
    </section>
@endsection
