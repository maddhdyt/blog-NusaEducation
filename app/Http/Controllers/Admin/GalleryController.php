<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $path = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/gallery'), $filename);
            $path = 'gallery/' . $filename;
        }

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
            if ($gallery->image_path) {
                $oldPath = public_path('storage/' . $gallery->image_path);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $file = $request->file('image');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/gallery'), $filename);
            $data['image_path'] = 'gallery/' . $filename;
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery item updated.');
    }

    public function destroy(GalleryItem $gallery)
    {
        if ($gallery->image_path) {
            $oldPath = public_path('storage/' . $gallery->image_path);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }
        $gallery->delete();
        return redirect()->route('admin.galleries.index')->with('success', 'Gallery item deleted.');
    }
}
