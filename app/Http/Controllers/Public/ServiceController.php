<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::with('category');

        // Filter by category
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $services = $query->orderBy('order')->orderBy('created_at', 'desc')->paginate(12);
        $categories = ServiceCategory::withCount('services')->get();

        return view('public.service.index', compact('services', 'categories'));
    }

    public function show($slug)
    {
        $service = Service::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        // Get related services
        $relatedServices = Service::where('service_category_id', $service->service_category_id)
            ->where('id', '!=', $service->id)
            ->orderBy('order')
            ->limit(3)
            ->get();

        return view('public.service.show', compact('service', 'relatedServices'));
    }
}
