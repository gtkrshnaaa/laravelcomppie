<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::withCount('services')->orderBy('name')->paginate(20);
        return view('admin.service.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.service.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:service_categories',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        ServiceCategory::create($validated);

        return redirect()->route('admin.service.categories.index')
            ->with('success', 'Service category created successfully.');
    }

    public function edit(ServiceCategory $category)
    {
        return view('admin.service.categories.edit', compact('category'));
    }

    public function update(Request $request, ServiceCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:service_categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('admin.service.categories.index')
            ->with('success', 'Service category updated successfully.');
    }

    public function destroy(ServiceCategory $category)
    {
        if ($category->services()->count() > 0) {
            return redirect()->route('admin.service.categories.index')
                ->with('error', 'Cannot delete category with existing services.');
        }

        $category->delete();

        return redirect()->route('admin.service.categories.index')
            ->with('success', 'Service category deleted successfully.');
    }
}
