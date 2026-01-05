<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with(['category', 'author', 'tags'])
            ->where('is_published', true)
            ->latest('published_at');

        // Filter by category
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by tag
        if ($request->has('tag')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Search
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $query->paginate(12);
        $categories = BlogCategory::withCount('posts')->get();
        $tags = BlogTag::withCount('posts')->get();

        return view('public.blog.index', compact('posts', 'categories', 'tags'));
    }

    public function show($slug)
    {
        $post = BlogPost::with(['category', 'author', 'tags'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Increment view count
        $post->increment('views_count');

        // Get related posts
        $relatedPosts = BlogPost::where('blog_category_id', $post->blog_category_id)
            ->where('id', '!=', $post->id)
            ->where('is_published', true)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('public.blog.show', compact('post', 'relatedPosts'));
    }
}
