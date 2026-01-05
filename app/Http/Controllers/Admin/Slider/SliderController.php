<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->paginate(20);
        return view('admin.slider.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.sliders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'link_url' => 'nullable|url',
            'button_text' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        Slider::create($validated);

        return redirect()->route('admin.slider.sliders.index')
            ->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'link_url' => 'nullable|url',
            'button_text' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        $slider->update($validated);

        return redirect()->route('admin.slider.sliders.index')
            ->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('admin.slider.sliders.index')
            ->with('success', 'Slider deleted successfully.');
    }
}
