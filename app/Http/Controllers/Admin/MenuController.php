<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with(['parent', 'children'])->orderBy('order')->paginate(15);
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $parentMenus = Menu::whereNull('parent_id')->orderBy('order')->get();
        $pages = Page::where('status', 'published')->get();
        $categories = Category::all();
        
        return view('admin.menus.create', compact('parentMenus', 'pages', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:menus,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:menus,slug',
            'url_type' => 'required|in:custom,page,post,category',
            'custom_url' => 'nullable|string',
            'page_id' => 'nullable|exists:pages,id',
            'category_id' => 'nullable|exists:categories,id',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);
        
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');
        
        Menu::create($validated);
        
        \Illuminate\Support\Facades\Cache::forget('navbar_menus');
        \Illuminate\Support\Facades\Cache::forget('footer_menus');
        
        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Menu $menu)
    {
        $parentMenus = Menu::whereNull('parent_id')
            ->where('id', '!=', $menu->id)
            ->orderBy('order')
            ->get();
        $pages = Page::where('status', 'published')->get();
        $categories = Category::all();
        
        return view('admin.menus.edit', compact('menu', 'parentMenus', 'pages', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:menus,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:menus,slug,' . $menu->id,
            'url_type' => 'required|in:custom,page,post,category',
            'custom_url' => 'nullable|string',
            'page_id' => 'nullable|exists:pages,id',
            'category_id' => 'nullable|exists:categories,id',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);
        
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');
        
        $menu->update($validated);
        
        \Illuminate\Support\Facades\Cache::forget('navbar_menus');
        \Illuminate\Support\Facades\Cache::forget('footer_menus');
        
        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        
        \Illuminate\Support\Facades\Cache::forget('navbar_menus');
        \Illuminate\Support\Facades\Cache::forget('footer_menus');
        
        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu deleted successfully.');
    }
}
