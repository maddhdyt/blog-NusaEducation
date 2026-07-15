<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()
            ->published()
            ->with(['user', 'category'])
            ->latest('published_at')
            ->paginate(12);
        
        $allCategories = Category::orderBy('name')->get();
        
        return view('frontend.category', compact('category', 'posts', 'allCategories'));
    }
}
