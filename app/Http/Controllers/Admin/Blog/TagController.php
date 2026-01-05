<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = BlogTag::withCount('posts')->orderBy('name')->paginate(20);
        return view('admin.blog.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.blog.tags.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:blog_tags',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        BlogTag::create($validated);

        return redirect()->route('admin.blog.tags.index')
            ->with('success', 'Blog tag created successfully.');
    }

    public function edit(BlogTag $tag)
    {
        return view('admin.blog.tags.edit', compact('tag'));
    }

    public function update(Request $request, BlogTag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:blog_tags,name,' . $tag->id,
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $tag->update($validated);

        return redirect()->route('admin.blog.tags.index')
            ->with('success', 'Blog tag updated successfully.');
    }

    public function destroy(BlogTag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.blog.tags.index')
            ->with('success', 'Blog tag deleted successfully.');
    }
}
