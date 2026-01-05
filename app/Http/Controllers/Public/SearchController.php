<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        
        if (empty($query)) {
            return view('public.search', [
                'query' => '',
                'results' => collect(),
                'totalResults' => 0,
            ]);
        }

        // Search Blog Posts
        $blogPosts = BlogPost::where('is_published', true)
            ->where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('content', 'like', '%' . $query . '%')
                  ->orWhere('excerpt', 'like', '%' . $query . '%');
            })
            ->with('category')
            ->limit(10)
            ->get()
            ->map(function($post) {
                return [
                    'type' => 'blog',
                    'title' => $post->title,
                    'excerpt' => $post->excerpt ?? strip_tags(substr($post->content, 0, 150)) . '...',
                    'url' => route('blog.show', $post->slug),
                    'category' => $post->category->name ?? 'Uncategorized',
                ];
            });

        // Search Portfolios
        $portfolios = Portfolio::where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%')
                  ->orWhere('client_company', 'like', '%' . $query . '%');
            })
            ->with('category')
            ->limit(10)
            ->get()
            ->map(function($portfolio) {
                return [
                    'type' => 'portfolio',
                    'title' => $portfolio->title,
                    'excerpt' => substr($portfolio->description, 0, 150) . '...',
                    'url' => route('portfolio.show', $portfolio->slug),
                    'category' => $portfolio->category->name ?? 'Uncategorized',
                ];
            });

        // Search Services
        $services = Service::where(function($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%')
                  ->orWhere('short_description', 'like', '%' . $query . '%');
            })
            ->with('category')
            ->limit(10)
            ->get()
            ->map(function($service) {
                return [
                    'type' => 'service',
                    'title' => $service->name,
                    'excerpt' => $service->short_description ?? substr($service->description, 0, 150) . '...',
                    'url' => route('services.show', $service->slug),
                    'category' => $service->category->name ?? 'Uncategorized',
                ];
            });

        // Combine and sort results
        $results = $blogPosts->concat($portfolios)->concat($services);
        $totalResults = $results->count();

        return view('public.search', compact('query', 'results', 'totalResults'));
    }
}
