<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewPostMail;
use App\Models\Post;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['category', 'user'])
            ->latest()
            ->paginate(15);
        
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:posts,slug',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'meta_description' => 'nullable|string|max:160',
            'focus_keyword' => 'nullable|string|max:255',
            'seo_score' => 'nullable|integer',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);
        
        $validated['user_id'] = auth()->id();
        $baseSlug = $validated['slug'] ?: $validated['title'];
        $validated['slug'] = $this->makeUniqueSlug($baseSlug);
        
        $validated['content'] = clean($validated['content']);
        
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
        
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }
        
        $post = Post::create($validated);

        \Illuminate\Support\Facades\Cache::forget('footer_posts');

        if ($post->status === 'published') {
            $this->notifySubscribers($post);
        }
        
        return redirect()->route('admin.posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:posts,slug,' . $post->id,
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'meta_description' => 'nullable|string|max:160',
            'focus_keyword' => 'nullable|string|max:255',
            'seo_score' => 'nullable|integer',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);
        
        $baseSlug = $validated['slug'] ?: $validated['title'];
        $validated['slug'] = $this->makeUniqueSlug($baseSlug, $post->id);
        
        $validated['content'] = clean($validated['content']);
        
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
        
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }
        
        $previousStatus = $post->status;

        $post->update($validated);

        \Illuminate\Support\Facades\Cache::forget('footer_posts');

        $justPublished = $previousStatus !== 'published' && $post->status === 'published';

        if ($justPublished) {
            $this->notifySubscribers($post);
        }
        
        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }
        
        $post->delete();
        
        \Illuminate\Support\Facades\Cache::forget('footer_posts');

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }

    private function notifySubscribers(Post $post): void
    {
        Subscriber::query()
            ->select(['id', 'email', 'name'])
            ->chunkById(200, function ($subscribers) use ($post) {
                foreach ($subscribers as $subscriber) {
                    if (!filter_var($subscriber->email, FILTER_VALIDATE_EMAIL)) {
                        continue;
                    }

                    Mail::to($subscriber->email)
                        ->send(new NewPostMail($post));
                }
            });
    }

    private function makeUniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($base);
        if (empty($baseSlug)) {
            $baseSlug = 'post';
        }

        $slug = $baseSlug;
        $counter = 2;

        while (
            Post::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
