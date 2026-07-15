<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\SidebarSetting;
use App\Models\GalleryItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $posts = Post::published()
            ->with(['category', 'user'])
            ->latest('published_at')
            ->take(24)
            ->get();

        $latestPosts = Post::published()
            ->with(['category', 'user'])
            ->latest('published_at')
            ->take(6)
            ->get();

        $trendingPosts = Post::published()
            ->with(['category', 'user'])
            ->latest('published_at')
            ->take(6)
            ->get();

        $categories = Category::has('publishedPosts')
            ->withCount('publishedPosts')
            ->limit(8)
            ->get();

        $sidebar = SidebarSetting::first();

        $galleryItems = GalleryItem::latest()->take(6)->get();

        return view('frontend.home', [
            'heroPost' => $posts->first(),
            'topStripPosts' => $posts->skip(1)->take(3),
            'featureGridPosts' => $latestPosts,
            'spotlightPosts' => $posts->skip(10)->take(6),
            'trendingPosts' => $trendingPosts,
            'categories' => $categories,
            'sidebar' => $sidebar,
            'galleryItems' => $galleryItems,
        ]);
    }
}
