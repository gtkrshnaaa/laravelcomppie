<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount('posts')->orderBy('name')->paginate(20);
        return view('admin.blog.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        BlogCategory::create($validated);

        return redirect()->route('admin.blog.categories.index')
            ->with('success', 'Blog category created successfully.');
    }

    public function edit(BlogCategory $category)
    {
        return view('admin.blog.categories.edit', compact('category'));
    }

    public function update(Request $request, BlogCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('admin.blog.categories.index')
            ->with('success', 'Blog category updated successfully.');
    }

    public function destroy(BlogCategory $category)
    {
        if ($category->posts()->count() > 0) {
            return redirect()->route('admin.blog.categories.index')
                ->with('error', 'Cannot delete category with existing posts.');
        }

        $category->delete();

        return redirect()->route('admin.blog.categories.index')
            ->with('success', 'Blog category deleted successfully.');
    }
}
