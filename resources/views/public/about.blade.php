@extends('layouts.public')

@section('title', 'About Us')

@section('content')
    <!-- Page Header -->
    <section class="pt-24 pb-12 bg-background">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-6xl font-bold text-primary mb-4">About Us</h1>
            <p class="text-secondary text-lg max-w-2xl">Learn more about our company, mission, and team</p>
        </div>
    </section>

    <!-- Company Info -->
    @if($companyInfo)
        <section class="py-20 bg-surface">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-3xl font-bold text-primary mb-6">Who We Are</h2>
                    <div class="prose prose-lg dark:prose-invert mx-auto">
                        <p class="text-secondary text-lg leading-relaxed">
                            {!! nl2br(e($companyInfo->description ?? 'We are a professional company dedicated to delivering excellence in everything we do.')) !!}
                        </p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Team Members -->
    @if($teamMembers->count() > 0)
        <section class="py-20 bg-background">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-primary mb-4">Our Team</h2>
                    <p class="text-secondary text-lg max-w-2xl mx-auto">
                        Meet the talented people behind our success
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
                    @foreach($teamMembers as $member)
                        <div class="group text-center">
                            <!-- Photo -->
                            <div class="aspect-square rounded-2xl overflow-hidden mb-4 bg-surface border border-border">
                                @if($member->photo)
                                    <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div class="w-24 h-24 rounded-full bg-primary/10 flex items-center justify-center text-3xl font-bold text-primary">
                                            {{ substr($member->name, 0, 1) }}
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Info -->
                            <h3 class="text-lg font-bold text-primary mb-1">{{ $member->name }}</h3>
                            <p class="text-secondary text-sm mb-2">{{ $member->position }}</p>
                            @if($member->department)
                                <p class="text-secondary text-xs">{{ $member->department }}</p>
                            @endif

                            <!-- Social Links -->
                            @if($member->social_links && count($member->social_links) > 0)
                                <div class="flex justify-center gap-2 mt-3">
                                    @foreach($member->social_links as $platform => $url)
                                        <a href="{{ $url }}" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-full bg-surface border border-border text-secondary hover:text-primary hover:border-primary/30 transition-colors">
                                            @if($platform === 'linkedin')
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                            @elseif($platform === 'twitter')
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                            @else
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
