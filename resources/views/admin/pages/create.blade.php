@extends('layouts.admin')

@section('title', 'Create Page')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.pages.index') }}" class="text-[#0a1435] hover:text-brand-primary font-bold text-sm uppercase tracking-wider transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Pages
        </a>
    </div>

    <form action="{{ route('admin.pages.store') }}" method="POST" class="block">
        @csrf
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Main Content Area -->
            <div class="xl:col-span-8 space-y-6">
                <!-- Title & Slug -->
                <div class="card p-6 space-y-6">
                    <div>
                        <label class="form-label" for="title">Title *</label>
                        <input type="text" name="title" id="title" class="form-input @error('title') border-red-500 @enderror" placeholder="Masukkan judul halaman..." value="{{ old('title') }}" required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label" for="slug">Slug (Optional)</label>
                        <input type="text" name="slug" id="slug" class="form-input @error('slug') border-red-500 @enderror" value="{{ old('slug') }}" placeholder="Leave blank to auto-generate from title">
                        @error('slug')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Editor -->
                <div class="card p-0">
                    <div class="p-4 border-b border-[#0a1435]">
                        <label class="form-label mb-0" for="content-editor">Content *</label>
                    </div>
                    <div id="content-editor" class="bg-white min-h-[500px] text-lg text-[#433836]" aria-label="Content editor">{!! old('content') !!}</div>
                    <input type="hidden" name="content" id="content" value="{{ old('content') }}" required>
                    @error('content')
                        <div class="p-4 bg-red-50"><p class="text-red-500 text-xs font-bold">{{ $message }}</p></div>
                    @enderror
                </div>

                <!-- SEO -->
                <div class="card p-6 space-y-6">
                    <div>
                        <label class="form-label" for="meta_description">Meta Description (SEO)</label>
                        <textarea name="meta_description" id="meta_description" rows="2" class="form-input @error('meta_description') border-red-500 @enderror" maxlength="160" placeholder="Max 160 characters for search engines...">{{ old('meta_description') }}</textarea>
                        @error('meta_description')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                        <p class="text-xs font-bold text-gray-500 mt-2 uppercase tracking-wider">Direkomendasikan untuk SEO yang lebih baik.</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Settings Area -->
            <div class="xl:col-span-4">
                <div class="space-y-6 sticky top-6">
                    <!-- Action Card -->
                    <div class="card p-6">
                        <h3 class="text-sm font-bold text-[#0a1435] mb-4 pb-2 border-b border-[#0a1435] uppercase tracking-wider mt-0">Publish</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="form-label" for="status">Status *</label>
                                <select name="status" id="status" class="form-input @error('status') border-red-500 @enderror" required>
                                    <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="pt-4 border-t border-[#0a1435] flex gap-3">
                                <button type="submit" class="w-full btn-primary py-3">Create Page</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
