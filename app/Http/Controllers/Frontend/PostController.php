<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SidebarSetting;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->with(['category', 'user'])
            ->latest('published_at')
            ->paginate(12);
        
        return view('frontend.posts.index', compact('posts'));
    }

    public function search(Request $request)
    {
        $query = trim($request->input('q', ''));

        $postsQuery = Post::published()
            ->with(['category', 'user'])
            ->latest('published_at');

        if ($query !== '') {
            $postsQuery->where(function ($sub) use ($query) {
                $sub->where('title', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            });
        }

        $posts = $postsQuery->paginate(12)->withQueryString();

        return view('frontend.posts.index', [
            'posts' => $posts,
            'searchQuery' => $query,
        ]);
    }

    public function show(Post $post)
    {
        if ($post->status !== 'published') {
            abort(404);
        }
        
        $post->load(['category', 'user']);
        
        $sessionKey = 'viewed_post_' . $post->id;
        if (!session()->has($sessionKey)) {
            $post->increment('views');
            session()->put($sessionKey, true);
        }
        
        $relatedPosts = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->limit(3)
            ->get();

        $sidebar = SidebarSetting::first();
        
        return view('frontend.posts.show', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'sidebar' => $sidebar,
            'title' => $post->title,
        ]);
    }
}
