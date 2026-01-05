@extends('layouts.public')

@section('title', $post->meta_title ?? $post->title)

@section('content')
    <!-- Article Header -->
    <article class="pt-24 pb-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <!-- Category & Date -->
            <div class="flex items-center gap-3 mb-6">
                <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}" class="px-3 py-1 rounded-full text-sm font-bold bg-primary/10 text-primary hover:bg-primary/20 transition-colors">
                    {{ $post->category->name }}
                </a>
                <span class="text-secondary text-sm">
                    {{ $post->published_at ? $post->published_at->format('F d, Y') : $post->created_at->format('F d, Y') }}
                </span>
            </div>

            <!-- Title -->
            <h1 class="text-4xl md:text-6xl font-bold text-primary mb-6 leading-tight">
                {{ $post->title }}
            </h1>

            <!-- Author Info -->
            <div class="flex items-center gap-4 pb-8 border-b border-border">
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-sm font-bold text-primary">
                    {{ substr($post->author->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-primary font-medium">{{ $post->author->name }}</p>
                    <p class="text-secondary text-sm">{{ ucwords(str_replace('_', ' ', $post->author->role)) }}</p>
                </div>
            </div>
        </div>
    </article>

    <!-- Featured Image -->
    @if($post->featured_image)
        <section class="pb-12">
            <div class="container mx-auto px-4 max-w-4xl">
                <div class="aspect-[16/9] rounded-2xl overflow-hidden bg-background">
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
            </div>
        </section>
    @endif

    <!-- Article Content -->
    <section class="pb-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="prose prose-lg dark:prose-invert max-w-none">
                <div class="text-primary leading-relaxed">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Tags -->
    @if($post->tags->count() > 0)
        <section class="pb-12 border-b border-border">
            <div class="container mx-auto px-4 max-w-4xl">
                <div class="flex flex-wrap gap-2">
                    <span class="text-secondary text-sm font-medium">Tags:</span>
                    @foreach($post->tags as $tag)
                        <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" class="px-3 py-1 rounded-full text-sm bg-background text-secondary hover:text-primary border border-border hover:border-primary/30 transition-colors">
                            {{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

<!-- Share Buttons -->
<section class="pb-12 border-b border-border">
    <div class="container mx-auto px-4 max-w-4xl">
        <x-share-buttons 
            :url="route('blog.show', $post->slug)" 
            :title="$post->title" 
        />
    </div>
</section>

    <!-- Related Posts -->
    @if($relatedPosts->count() > 0)
        <section class="py-20 bg-surface">
            <div class="container mx-auto px-4 max-w-6xl">
                <h2 class="text-3xl font-bold text-primary mb-8">Related Articles</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $relatedPost)
                        <article class="group bg-background border border-border rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                            <!-- Featured Image -->
                            <div class="aspect-[16/10] bg-background/50 overflow-hidden">
                                @if($relatedPost->featured_image)
                                    <img src="{{ Storage::url($relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 opacity-30">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-primary mb-2 group-hover:text-blue-500 transition-colors line-clamp-2">
                                    <a href="{{ route('blog.show', $relatedPost->slug) }}">{{ $relatedPost->title }}</a>
                                </h3>
                                <p class="text-secondary text-sm line-clamp-2">
                                    {{ $relatedPost->excerpt ?? Str::limit(strip_tags($relatedPost->content), 100) }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Back to Blog -->
    <section class="py-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-secondary hover:text-primary transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Blog
            </a>
        </div>
    </section>
@endsection
