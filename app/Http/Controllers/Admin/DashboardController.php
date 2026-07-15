<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Category;
use App\Models\Post;
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
        ];
        
        $recentPosts = Post::with(['category', 'user'])
            ->latest('created_at')
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact('stats', 'recentPosts'));
    }
}
