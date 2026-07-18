<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Subscriber;
use App\Models\GalleryItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'menus' => Menu::count(),
            'pages' => Page::count(),
            'categories' => Category::count(),
            'posts' => Post::count(),
            'published_posts' => Post::where('status', 'published')->count(),
            'draft_posts' => Post::where('status', 'draft')->count(),
            'views' => Post::sum('views'),
            'users' => User::count(),
            'subscribers' => Subscriber::count(),
            'galleries' => GalleryItem::count(),
        ];
        
        $recentPosts = Post::with(['category', 'user'])
            ->latest('created_at')
            ->limit(5)
            ->get();
            
        $popularPosts = Post::where('status', 'published')
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get();

        // Data for Category Distribution Chart
        $categoryDistribution = Category::has('posts')->withCount('posts')->orderByDesc('posts_count')->get();
        $chartData = [
            'labels' => $categoryDistribution->pluck('name')->toArray(),
            'data' => $categoryDistribution->pluck('posts_count')->toArray(),
        ];

        // Data for Views Chart (Top 7)
        $topPosts = Post::where('status', 'published')->orderBy('views', 'desc')->limit(7)->get();
        $viewsChartData = [
            'labels' => $topPosts->pluck('title')->map(function($title) {
                return strlen($title) > 15 ? substr($title, 0, 15) . '...' : $title;
            })->toArray(),
            'data' => $topPosts->pluck('views')->toArray(),
        ];
        
        return view('admin.dashboard', compact('stats', 'recentPosts', 'popularPosts', 'chartData', 'viewsChartData'));
    }
}
