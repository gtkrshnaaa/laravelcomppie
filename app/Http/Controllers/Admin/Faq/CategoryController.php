<?php

namespace App\Http\Controllers\Admin\Faq;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::withCount('faqs')->orderBy('order')->paginate(20);
        return view('admin.faq.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.faq.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:faq_categories',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        FaqCategory::create($validated);

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'FAQ category created successfully.');
    }

    public function edit(FaqCategory $category)
    {
        return view('admin.faq.categories.edit', compact('category'));
    }

    public function update(Request $request, FaqCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:faq_categories,name,' . $category->id,
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'FAQ category updated successfully.');
    }

    public function destroy(FaqCategory $category)
    {
        if ($category->faqs()->count() > 0) {
            return redirect()->route('admin.faq.categories.index')
                ->with('error', 'Cannot delete category with existing FAQs.');
        }

        $category->delete();

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'FAQ category deleted successfully.');
    }
}
