@extends('layouts.admin')

@section('title', 'Create Page')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Create New Page</h1>
    </div>

    <div class="card p-6">
        <form action="{{ route('admin.pages.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Title *</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('title') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    required>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Slug</label>
                <input type="text" name="slug" value="{{ old('slug') }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('slug') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    placeholder="Leave blank for auto-generate">
                @error('slug')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-1">Leave blank to auto-generate from title</p>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800" for="content-editor">Content *</label>
                <div id="content-editor" class="bg-white border border-gray-200 rounded-lg min-h-[240px]"
                    aria-label="Content editor">{!! old('content') !!}</div>
                <input type="hidden" name="content" id="content" value="{{ old('content') }}" required>
                <p class="text-xs text-gray-500">Gunakan toolbar untuk menambah link, gambar, dan format teks.</p>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Meta Description</label>
                <textarea name="meta_description" rows="2"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('meta_description') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('meta_description') }}</textarea>
                @error('meta_description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Status *</label>
                <select name="status"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white @error('status') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    required>
                    <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn-primary">Create Page</button>
                <a href="{{ route('admin.pages.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    {{-- Quill assets and init --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
    <script>
        const quill = new Quill('#content-editor', {
            theme: 'snow',
            placeholder: 'Tulis konten halaman di sini...',
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, 3, false]
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        list: 'ordered'
                    }, {
                        list: 'bullet'
                    }],
                    ['link', 'image'],
                    ['blockquote', 'code-block'],
                    [{
                        align: []
                    }],
                    ['clean']
                ]
            }
        });

        const contentInput = document.getElementById('content');
        quill.on('text-change', () => {
            contentInput.value = quill.root.innerHTML;
        });
        contentInput.value = quill.root.innerHTML;
    </script>
@endsection
