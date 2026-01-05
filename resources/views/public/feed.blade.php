<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ config('app.name') }} Blog</title>
        <link>{{ url('/') }}</link>
        <description>Latest articles from {{ config('app.name') }}</description>
        <language>en-us</language>
        <lastBuildDate>{{ now()->toRssString() }}</lastBuildDate>
        <atom:link href="{{ route('feed') }}" rel="self" type="application/rss+xml"/>

        @foreach($posts as $post)
        <item>
            <title><![CDATA[{{ $post->title }}]]></title>
            <link>{{ route('blog.show', $post->slug) }}</link>
            <description><![CDATA[{{ $post->excerpt ?? strip_tags(substr($post->content, 0, 300)) }}]]></description>
            <author><![CDATA[{{ $post->author->name }}]]></author>
            <category>{{ $post->category->name }}</category>
            <pubDate>{{ $post->published_at ? $post->published_at->toRssString() : $post->created_at->toRssString() }}</pubDate>
            <guid>{{ route('blog.show', $post->slug) }}</guid>
        </item>
        @endforeach
    </channel>
</rss>
