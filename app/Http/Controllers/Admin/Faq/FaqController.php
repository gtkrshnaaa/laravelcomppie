<?php

namespace App\Http\Controllers\Admin\Faq;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::with('category')->orderBy('order')->paginate(20);
        return view('admin.faq.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $categories = FaqCategory::orderBy('name')->get();
        return view('admin.faq.faqs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string',
            'answer' => 'required|string',
            'order' => 'nullable|integer|min:0',
        ]);

        Faq::create($validated);

        return redirect()->route('admin.faq.faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq)
    {
        $categories = FaqCategory::orderBy('name')->get();
        return view('admin.faq.faqs.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string',
            'answer' => 'required|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $faq->update($validated);

        return redirect()->route('admin.faq.faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faq.faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }
}
