<?php

namespace App\Http\Controllers\Admin\Testimonial;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(20);
        return view('admin.testimonial.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonial.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'rating' => 'required|integer|min:1|max:5',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_approved'] = $request->has('is_approved');
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonial.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'rating' => 'required|integer|min:1|max:5',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_approved'] = $request->has('is_approved');
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('photo')) {
            if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
                Storage::disk('public')->delete($testimonial->photo);
            }
            $validated['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonial.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
            Storage::disk('public')->delete($testimonial->photo);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonial.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }
}
