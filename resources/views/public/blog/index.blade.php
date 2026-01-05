@extends('layouts.public')

@section('title', 'Blog')

@section('content')
    <!-- Page Header -->
    <section class="pt-24 pb-12 bg-background">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-6xl font-bold text-primary mb-4">Blog & Articles</h1>
            <p class="text-secondary text-lg max-w-2xl">Latest insights, tutorials, and updates from our team</p>
        </div>
    </section>

    <!-- Filters -->
    <section class="py-8 border-b border-border bg-surface">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row gap-4 items-start md:items-center justify-between">
                <!-- Search -->
                <form method="GET" class="flex-1 max-w-md">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search articles..." class="w-full px-4 py-2 pl-10 rounded-lg border border-border bg-background text-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                        <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </form>

                <!-- Category Filter -->
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('blog.index') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ !request('category') ? 'bg-primary text-background' : 'bg-background text-secondary hover:text-primary' }} border border-border transition-colors">
                        All
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('category') === $category->slug ? 'bg-primary text-background' : 'bg-background text-secondary hover:text-primary' }} border border-border transition-colors">
                            {{ $category->name }} ({{ $category->posts_count }})
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Posts Grid -->
    <section class="py-20 bg-background">
        <div class="container mx-auto px-4">
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($posts as $post)
                        <article class="group bg-surface border border-border rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                            <!-- Featured Image -->
                            <div class="aspect-[16/10] bg-background/50 overflow-hidden">
                                @if($post->featured_image)
                                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
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
                                <!-- Meta -->
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="px-2 py-1 rounded text-xs font-bold bg-primary/10 text-primary">
                                        {{ $post->category->name }}
                                    </span>
                                    <span class="text-xs text-secondary">
                                        {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                                    </span>
                                </div>

                                <!-- Title -->
                                <h3 class="text-xl font-bold text-primary mb-2 group-hover:text-blue-500 transition-colors line-clamp-2">
                                    <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>

                                <!-- Excerpt -->
                                <p class="text-secondary text-sm mb-4 line-clamp-3">
                                    {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 150) }}
                                </p>

                                <!-- Read More -->
                                <a href="{{ route('blog.show', $post->slug) }}" class="text-sm font-bold text-primary hover:underline flex items-center gap-1">
                                    Read More
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
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="text-secondary mb-4">
                        <svg class="w-16 h-16 mx-auto opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-primary text-lg font-medium mb-2">No articles found</p>
                    <p class="text-secondary">Try adjusting your filters or check back later</p>
                </div>
            @endif
        </div>
    </section>
@endsection
