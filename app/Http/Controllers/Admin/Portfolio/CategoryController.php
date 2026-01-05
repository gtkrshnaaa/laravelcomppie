<?php

namespace App\Http\Controllers\Admin\Portfolio;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = PortfolioCategory::withCount('portfolios')->orderBy('name')->paginate(20);
        return view('admin.portfolio.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.portfolio.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:portfolio_categories',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        PortfolioCategory::create($validated);

        return redirect()->route('admin.portfolio.categories.index')
            ->with('success', 'Portfolio category created successfully.');
    }

    public function edit(PortfolioCategory $category)
    {
        return view('admin.portfolio.categories.edit', compact('category'));
    }

    public function update(Request $request, PortfolioCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:portfolio_categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('admin.portfolio.categories.index')
            ->with('success', 'Portfolio category updated successfully.');
    }

    public function destroy(PortfolioCategory $category)
    {
        if ($category->portfolios()->count() > 0) {
            return redirect()->route('admin.portfolio.categories.index')
                ->with('error', 'Cannot delete category with existing portfolios.');
        }

        $category->delete();

        return redirect()->route('admin.portfolio.categories.index')
            ->with('success', 'Portfolio category deleted successfully.');
    }
}
