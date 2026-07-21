@extends('layouts.admin')

@section('page_title', 'Create Post')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.posts.index') }}" class="text-[#0a1435] hover:text-brand-primary font-bold text-sm uppercase tracking-wider transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Posts
        </a>
    </div>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="block">
        @csrf
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Main Content Area -->
            <div class="xl:col-span-8 space-y-6">
                <!-- Title & Slug -->
                <div class="card p-6 space-y-6">
                    <div>
                        <label class="form-label" for="title">Title *</label>
                        <input type="text" name="title" id="title" class="form-input @error('title') border-red-500 @enderror" placeholder="Masukkan judul postingan..." value="{{ old('title') }}" required>
                        @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="slug">Slug (Optional)</label>
                        <input type="text" name="slug" id="slug" class="form-input" value="{{ old('slug') }}" placeholder="Leave blank to auto-generate from title">
                    </div>
                </div>

                <!-- Editor -->
                <div class="card p-0">
                    <div class="p-4 border-b border-[#0a1435]">
                        <label class="form-label mb-0" for="content-editor">Content *</label>
                    </div>
                    <div id="content-editor" class="bg-white min-h-[500px] text-lg text-[#433836]" aria-label="Content editor">{!! old('content') !!}</div>
                    <input type="hidden" name="content" id="content" value="{{ old('content') }}" required>
                </div>

                <!-- Excerpt & SEO -->
                <div class="card p-6 space-y-6">
                    <div>
                        <label class="form-label" for="excerpt">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" rows="3" class="form-input" placeholder="Ringkasan singkat artikel...">{{ old('excerpt') }}</textarea>
                    </div>
                    <div>
                        <label class="form-label" for="meta_description">Meta Description (SEO)</label>
                        <textarea name="meta_description" id="meta_description" rows="2" class="form-input" maxlength="160" placeholder="Max 160 characters for search engines...">{{ old('meta_description') }}</textarea>
                        <p class="text-xs font-bold text-gray-500 mt-2 uppercase tracking-wider">Direkomendasikan untuk SEO yang lebih baik.</p>
                    </div>
                </div>

                <!-- SEO Analyzer -->
                <div class="card p-6 space-y-6">
                    <h3 class="text-xl font-bold text-[#0a1435] mb-4 pb-2 border-b border-[#0a1435] uppercase tracking-wider">SEO Analyzer</h3>
                    
                    <div>
                        <label class="form-label" for="focus_keyword">Focus Keyword</label>
                        <input type="text" name="focus_keyword" id="focus_keyword" class="form-input" placeholder="Masukkan kata kunci utama (contoh: belajar laravel)..." value="{{ old('focus_keyword') }}">
                    </div>

                    <!-- Google Search Preview -->
                    <div class="mt-6 border border-gray-200 rounded-lg p-4 bg-white shadow-sm">
                        <h4 class="text-sm font-bold text-gray-500 mb-2 uppercase tracking-wider">Google Search Preview</h4>
                        <div class="google-preview" style="font-family: Arial, sans-serif; max-width: 600px;">
                            <div class="text-[14px] text-[#202124] mb-1 flex items-center gap-2">
                                <span class="bg-gray-200 w-5 h-5 rounded-full inline-block"></span> 
                                <span id="seo-preview-url">https://blog.nusaeducation.com/post/judul-post</span>
                            </div>
                            <div class="text-[20px] text-[#1a0dab] font-normal hover:underline cursor-pointer truncate" id="seo-preview-title">Judul Postingan Akan Muncul Di Sini - Nusa Education</div>
                            <div class="text-[14px] text-[#4d5156] line-clamp-2 leading-[1.58] mt-1" id="seo-preview-desc">Deskripsi meta belum diisi. Masukkan deskripsi meta agar muncul di hasil pencarian Google dengan rapi.</div>
                        </div>
                    </div>

                    <!-- Analysis Checklist -->
                    <div class="mt-6">
                        <h4 class="text-sm font-bold text-gray-500 mb-3 uppercase tracking-wider">Analysis Results</h4>
                        <ul class="space-y-3" id="seo-checklist">
                            <li class="flex items-center gap-2 text-sm text-gray-500"><span class="w-3 h-3 rounded-full bg-gray-300"></span> Masukkan Focus Keyword terlebih dahulu.</li>
                        </ul>
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
                            <select name="status" id="status" class="form-input" required>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label" for="published_at">Publish Date</label>
                            <input type="datetime-local" name="published_at" id="published_at" class="form-input" value="{{ old('published_at') }}">
                        </div>
                        <div class="pt-4 border-t border-[#0a1435] flex gap-3">
                            <button type="submit" class="w-full btn-primary py-3">Save Post</button>
                        </div>
                    </div>
                </div>

                <!-- Organization Card -->
                <div class="card p-6">
                    <h3 class="text-sm font-bold text-[#0a1435] mb-4 pb-2 border-b border-[#0a1435] uppercase tracking-wider">Organization</h3>
                    <div>
                        <label class="form-label" for="category_id">Category *</label>
                        <select name="category_id" id="category_id" class="form-input" required>
                            <option value="">Select a Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Media Card -->
                <div class="card p-6">
                    <h3 class="text-sm font-bold text-[#0a1435] mb-4 pb-2 border-b border-[#0a1435] uppercase tracking-wider">Media</h3>
                    <div>
                        <label class="form-label" for="thumbnail">Thumbnail Image</label>
                        <input type="file" name="thumbnail" id="thumbnail" class="form-input" accept="image/*">
                        <p class="text-xs font-bold text-gray-500 mt-2 uppercase tracking-wider">PNG, JPG, GIF up to 2MB</p>
                        <p id="thumbnail-warning" class="text-xs font-bold mt-1 uppercase tracking-wider hidden"></p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Quill assets and init --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/compressorjs@1.2.1/dist/compressor.min.js"></script>
    <script>
        function imageHandler() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = async () => {
                const file = input.files[0];
                if (!file) return;

                const uploadFile = async (fileToUpload) => {
                    const formData = new FormData();
                    formData.append('image', fileToUpload, fileToUpload.name || 'image.jpg');
                    try {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const response = await fetch("{{ route('admin.posts.upload_image') }}", {
                            method: 'POST',
                            body: formData,
                            headers: { 'X-CSRF-TOKEN': csrfToken }
                        });
                        if (response.ok) {
                            const data = await response.json();
                            let range = quill.getSelection(true);
                            let index = range ? range.index : quill.getLength();
                            quill.insertEmbed(index, 'image', data.url);
                            quill.setSelection(index + 1);
                        } else {
                            alert('Gagal mengunggah gambar. Pastikan ukuran di bawah 5MB.');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan jaringan saat mengunggah.');
                    }
                };

                if (file.size > 1024 * 1024) {
                    new Compressor(file, {
                        quality: 0.8,
                        maxWidth: 1920,
                        maxHeight: 1920,
                        success(result) { uploadFile(result); },
                        error(err) { 
                            console.error('Compression error:', err.message);
                            uploadFile(file);
                        },
                    });
                } else {
                    uploadFile(file);
                }
            };
        }

        const quill = new Quill('#content-editor', {
            theme: 'snow',
            placeholder: 'Tulis konten di sini...',
            modules: {
                toolbar: {
                    container: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        ['link', 'image'],
                        ['blockquote', 'code-block'],
                        [{ align: [] }],
                        ['clean']
                    ],
                    handlers: {
                        image: imageHandler
                    }
                }
            }
        });

        const contentInput = document.getElementById('content');
        quill.on('text-change', () => {
            contentInput.value = quill.root.innerHTML;
        });

        // Initialize with existing content if any (ensures hidden input synced on load)
        contentInput.value = quill.root.innerHTML;
        
        // Thumbnail compression logic
        const thumbnailInput = document.getElementById('thumbnail');
        const thumbnailWarning = document.getElementById('thumbnail-warning');
        const submitBtn = document.querySelector('button[type="submit"]');

        if (thumbnailInput) {
            thumbnailInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                
                if (!file) {
                    if (thumbnailWarning) thumbnailWarning.classList.add('hidden');
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    thumbnailWarning.textContent = `Ukuran asli ${(file.size / 1024 / 1024).toFixed(2)}MB. Sedang mengompresi...`;
                    thumbnailWarning.classList.remove('hidden', 'text-red-500', 'text-green-500');
                    thumbnailWarning.classList.add('text-orange-500');
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');

                    new Compressor(file, {
                        quality: 0.8,
                        maxWidth: 1920,
                        maxHeight: 1920,
                        success(result) {
                            if (result.size > 2 * 1024 * 1024) {
                                thumbnailWarning.textContent = `Gagal! Setelah dikompresi ukuran masih ${(result.size / 1024 / 1024).toFixed(2)}MB (>2MB). Harap ganti gambar.`;
                                thumbnailWarning.classList.remove('text-orange-500', 'text-green-500');
                                thumbnailWarning.classList.add('text-red-500');
                            } else {
                                thumbnailWarning.textContent = `Sukses! Dikompresi menjadi ${(result.size / 1024).toFixed(0)}KB. Aman diunggah.`;
                                thumbnailWarning.classList.remove('text-orange-500', 'text-red-500');
                                thumbnailWarning.classList.add('text-green-500');
                                submitBtn.disabled = false;
                                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                                
                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(new File([result], result.name || 'thumbnail.jpg', { type: result.type }));
                                thumbnailInput.files = dataTransfer.files;
                            }
                        },
                        error(err) {
                            console.error(err.message);
                            thumbnailWarning.textContent = 'Gagal mengompresi gambar.';
                            thumbnailWarning.classList.remove('text-orange-500', 'text-green-500');
                            thumbnailWarning.classList.add('text-red-500');
                        },
                    });
                } else {
                    if (thumbnailWarning) thumbnailWarning.classList.add('hidden');
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                }
            });
        }
    </script>
    <script src="{{ asset('js/seo-analyzer.js') }}"></script>
@endsection
