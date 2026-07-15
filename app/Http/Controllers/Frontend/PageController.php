<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Page $page)
    {
        if ($page->status !== 'published') {
            abort(404);
        }
        
        return view('frontend.page', compact('page'));
    }
}
