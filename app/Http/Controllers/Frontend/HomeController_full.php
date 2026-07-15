<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featuredPosts = Post::published()
            ->with(['category', 'user'])
            ->latest('published_at')
            ->limit(6)
            ->get();
        
        $categories = Category::withCount('publishedPosts')
            ->having('published_posts_count', '>', 0)
            ->limit(6)
            ->get();
        
        return view('frontend.home', compact('featuredPosts', 'categories'));
    }
}
