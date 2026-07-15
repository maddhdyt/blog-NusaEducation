@extends('layouts.admin')

@section('page_title', 'Edit Post')

@section('content')
    <div class="max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('admin.posts.index') }}" class="text-blue-600 hover:text-blue-800">← Back to Posts</a>
        </div>

        <div class="card p-6">
            <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label" for="title">Title *</label>
                    <input type="text" name="title" id="title" class="form-input"
                        value="{{ old('title', $post->title) }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-input"
                        value="{{ old('slug', $post->slug) }}">
                </div>

                <div class="mb-4">
                    <label class="form-label" for="category_id">Category *</label>
                    <select name="category_id" id="category_id" class="form-input" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="excerpt">Excerpt</label>
                    <textarea name="excerpt" id="excerpt" rows="2" class="form-input">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="content-editor">Content *</label>
                    <div id="content-editor" class="bg-white border border-gray-200 rounded-lg min-h-[240px]"
                        aria-label="Content editor">{!! old('content', $post->content) !!}</div>
                    <input type="hidden" name="content" id="content" value="{{ old('content', $post->content) }}"
                        required>
                    <p class="text-sm text-gray-500 mt-1">Gunakan toolbar untuk menambah link, gambar, dan format teks.</p>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="thumbnail">Thumbnail Image</label>
                    @if ($post->thumbnail)
                        <div class="mb-2">
                            <img src="{{ $post->thumbnail_url }}" alt="Current thumbnail"
                                class="w-48 h-32 object-cover rounded">
                            <p class="text-sm text-gray-500 mt-1">Current thumbnail</p>
                        </div>
                    @endif
                    <input type="file" name="thumbnail" id="thumbnail" class="form-input" accept="image/*">
                </div>

                <div class="mb-4">
                    <label class="form-label" for="meta_description">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="2" class="form-input" maxlength="160">{{ old('meta_description', $post->meta_description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="status">Status *</label>
                    <select name="status" id="status" class="form-input" required>
                        <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft
                        </option>
                        <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>
                            Published</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="form-label" for="published_at">Publish Date</label>
                    <input type="datetime-local" name="published_at" id="published_at" class="form-input"
                        value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}">
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="btn-primary">Update Post</button>
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
        contentInput.value = quill.root.innerHTML;
    </script>
@endsection
