<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $posts = Post::published()->latest('published_at')->get();
        $categories = Category::all();
        $pages = Page::where('status', 'published')->get();

        return response()->view('frontend.sitemap', [
            'posts' => $posts,
            'categories' => $categories,
            'pages' => $pages,
        ])->header('Content-Type', 'text/xml');
    }
}
