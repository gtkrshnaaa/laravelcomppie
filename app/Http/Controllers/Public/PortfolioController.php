<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $query = Portfolio::with('category')->where('is_featured', '>=', 0);

        // Filter by category
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $portfolios = $query->orderBy('order')->orderBy('created_at', 'desc')->paginate(12);
        $categories = PortfolioCategory::withCount('portfolios')->get();

        return view('public.portfolio.index', compact('portfolios', 'categories'));
    }

    public function show($slug)
    {
        $portfolio = Portfolio::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        // Get related portfolios
        $relatedPortfolios = Portfolio::where('portfolio_category_id', $portfolio->portfolio_category_id)
            ->where('id', '!=', $portfolio->id)
            ->orderBy('order')
            ->limit(3)
            ->get();

        return view('public.portfolio.show', compact('portfolio', 'relatedPortfolios'));
    }
}
