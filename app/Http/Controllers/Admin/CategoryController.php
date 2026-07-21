<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->latest()->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categories,slug',
            'description' => 'nullable|string',
            'meta_description' => 'nullable|string|max:160',
        ]);
        
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        
        Category::create($validated);
        
        \Illuminate\Support\Facades\Cache::forget('footer_categories');
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $slug = Str::slug($validated['name']);
        
        if (Category::where('slug', $slug)->exists()) {
            return response()->json(['message' => 'Category already exists'], 422);
        }
        
        $category = Category::create([
            'name' => $validated['name'],
            'slug' => $slug,
        ]);
        
        \Illuminate\Support\Facades\Cache::forget('footer_categories');
        
        return response()->json([
            'id' => $category->id,
            'name' => $category->name
        ]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->get();
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'meta_description' => 'nullable|string|max:160',
        ]);
        
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        
        $category->update($validated);
        
        \Illuminate\Support\Facades\Cache::forget('footer_categories');
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        
        \Illuminate\Support\Facades\Cache::forget('footer_categories');
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
