@extends('layouts.public')

@section('title', $service->name . ' - Services')

@section('content')
    <!-- Service Header -->
    <section class="pt-24 pb-12">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Category -->
            <a href="{{ route('services.index', ['category' => $service->category->slug]) }}" class="inline-block px-3 py-1 rounded-full text-sm font-bold bg-primary/10 text-primary hover:bg-primary/20 transition-colors mb-6">
                {{ $service->category->name }}
            </a>

            <!-- Title -->
            <h1 class="text-4xl md:text-6xl font-bold text-primary mb-6 leading-tight">
                {{ $service->name }}
            </h1>

            <!-- Short Description -->
            @if($service->short_description)
                <p class="text-secondary text-xl mb-8 max-w-3xl">
                    {{ $service->short_description }}
                </p>
            @endif

            <!-- Price -->
            @if($service->price_starting_from)
                <div class="inline-flex items-center gap-2 bg-surface border border-border rounded-full px-6 py-3">
                    <span class="text-secondary text-sm">Starting from</span>
                    <span class="text-primary font-bold text-2xl">${{ number_format($service->price_starting_from, 2) }}</span>
                </div>
            @endif
        </div>
    </section>

    <!-- Service Image -->
    @if($service->image)
        <section class="pb-12">
            <div class="container mx-auto px-4 max-w-6xl">
                <div class="aspect-[16/9] rounded-2xl overflow-hidden bg-background">
                    <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-cover">
                </div>
            </div>
        </section>
    @endif

    <!-- Service Description -->
    <section class="pb-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="prose prose-lg dark:prose-invert max-w-none">
                <div class="text-primary leading-relaxed">
                    {!! nl2br(e($service->description)) !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    @if($service->features && count($service->features) > 0)
        <section class="py-12 bg-surface">
            <div class="container mx-auto px-4 max-w-4xl">
                <h2 class="text-2xl font-bold text-primary mb-8">Key Features</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($service->features as $feature)
                        <div class="flex items-start gap-3 p-4 bg-background rounded-xl border border-border">
                            <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-primary">{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="py-20 bg-background">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="bg-primary rounded-2xl p-12 text-center">
                <h2 class="text-3xl font-bold text-background mb-4">Interested in this service?</h2>
                <p class="text-background/80 text-lg mb-8 max-w-2xl mx-auto">
                    Get in touch with us to discuss how we can help you achieve your goals
                </p>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 bg-background text-primary font-bold px-8 py-4 rounded-xl hover:opacity-90 transition-opacity">
                    Contact Us
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Related Services -->
    @if($relatedServices->count() > 0)
        <section class="py-20 bg-surface">
            <div class="container mx-auto px-4 max-w-6xl">
                <h2 class="text-3xl font-bold text-primary mb-8">Related Services</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedServices as $related)
                        <article class="group bg-background border border-border rounded-2xl p-6 hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                            <h3 class="text-lg font-bold text-primary mb-2 group-hover:text-blue-500 transition-colors">
                                <a href="{{ route('services.show', $related->slug) }}">{{ $related->name }}</a>
                            </h3>
                            <p class="text-secondary text-sm line-clamp-2">
                                {{ $related->short_description ?? Str::limit(strip_tags($related->description), 100) }}
                            </p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Back to Services -->
    <section class="py-12">
        <div class="container mx-auto px-4 max-w-6xl">
            <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-secondary hover:text-primary transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Services
            </a>
        </div>
    </section>
@endsection
