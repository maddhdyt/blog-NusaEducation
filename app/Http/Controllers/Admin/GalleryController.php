<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $items = GalleryItem::latest()->paginate(12);
        return view('admin.galleries.index', compact('items'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['required', 'image', 'max:4096'],
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        GalleryItem::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'image_path' => $path,
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery item created.');
    }

    public function edit(GalleryItem $gallery)
    {
        return view('admin.galleries.edit', ['item' => $gallery]);
    }

    public function update(Request $request, GalleryItem $gallery)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            $data['image_path'] = $path;
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery item updated.');
    }

    public function destroy(GalleryItem $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.galleries.index')->with('success', 'Gallery item deleted.');
    }
}
