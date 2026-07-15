@extends('layouts.admin')

@section('page_title', 'Create Post')

@section('content')
    <div class="max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('admin.posts.index') }}" class="text-blue-600 hover:text-blue-800">← Back to Posts</a>
        </div>

        <div class="card p-6">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="form-label" for="title">Title *</label>
                    <input type="text" name="title" id="title" class="form-input" value="{{ old('title') }}"
                        required>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="slug">Slug (optional)</label>
                    <input type="text" name="slug" id="slug" class="form-input" value="{{ old('slug') }}">
                    <p class="text-sm text-gray-500 mt-1">Leave blank to auto-generate from title</p>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="category_id">Category *</label>
                    <select name="category_id" id="category_id" class="form-input" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="excerpt">Excerpt</label>
                    <textarea name="excerpt" id="excerpt" rows="2" class="form-input">{{ old('excerpt') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="content-editor">Content *</label>
                    <div id="content-editor" class="bg-white border border-gray-200 rounded-lg min-h-[240px]"
                        aria-label="Content editor">{!! old('content') !!}</div>
                    <input type="hidden" name="content" id="content" value="{{ old('content') }}" required>
                    <p class="text-sm text-gray-500 mt-1">Gunakan toolbar untuk menambah link, gambar, dan format teks.</p>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="thumbnail">Thumbnail Image</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-input" accept="image/*">
                </div>

                <div class="mb-4">
                    <label class="form-label" for="meta_description">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="2" class="form-input" maxlength="160">{{ old('meta_description') }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Max 160 characters for SEO</p>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="status">Status *</label>
                    <select name="status" id="status" class="form-input" required>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="form-label" for="published_at">Publish Date (optional)</label>
                    <input type="datetime-local" name="published_at" id="published_at" class="form-input"
                        value="{{ old('published_at') }}">
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="btn-primary">Create Post</button>
                    <a href="{{ route('admin.posts.index') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Quill assets and init --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
    <script>
        const quill = new Quill('#content-editor', {
            theme: 'snow',
            placeholder: 'Tulis konten di sini...',
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

        // Initialize with existing content if any (ensures hidden input synced on load)
        contentInput.value = quill.root.innerHTML;
    </script>
@endsection
