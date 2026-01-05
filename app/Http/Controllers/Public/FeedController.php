<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;

class FeedController extends Controller
{
    public function index()
    {
        $posts = BlogPost::where('is_published', true)
            ->with(['category', 'author'])
            ->latest('published_at')
            ->limit(20)
            ->get();

        return response()->view('public.feed', compact('posts'))
            ->header('Content-Type', 'application/xml');
    }
}
