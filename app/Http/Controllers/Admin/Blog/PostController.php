<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with(['category', 'author', 'tags'])->latest()->paginate(20);
        return view('admin.blog.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::orderBy('name')->get();
        $tags = BlogTag::orderBy('name')->get();
        return view('admin.blog.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'blog_category_id' => 'required|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = auth()->id();
        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $tags = $validated['tags'] ?? [];
        unset($validated['tags']);

        $post = BlogPost::create($validated);
        
        if (!empty($tags)) {
            $post->tags()->sync($tags);
        }

        return redirect()->route('admin.blog.posts.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $post)
    {
        $categories = BlogCategory::orderBy('name')->get();
        $tags = BlogTag::orderBy('name')->get();
        return view('admin.blog.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $validated = $request->validate([
            'blog_category_id' => 'required|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $tags = $validated['tags'] ?? [];
        unset($validated['tags']);

        $post->update($validated);
        
        if (!empty($tags)) {
            $post->tags()->sync($tags);
        }

        return redirect()->route('admin.blog.posts.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $post)
    {
        if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('admin.blog.posts.index')
            ->with('success', 'Blog post deleted successfully.');
    }
}
