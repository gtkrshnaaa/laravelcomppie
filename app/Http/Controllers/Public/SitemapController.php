<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Portfolio;
use App\Models\Service;

class SitemapController extends Controller
{
    public function index()
    {
        $blogPosts = BlogPost::where('is_published', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        $portfolios = Portfolio::orderBy('updated_at', 'desc')->get();
        
        $services = Service::orderBy('updated_at', 'desc')->get();

        return response()->view('public.sitemap', compact('blogPosts', 'portfolios', 'services'))
            ->header('Content-Type', 'application/xml');
    }
}
