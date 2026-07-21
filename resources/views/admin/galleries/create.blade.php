@extends('layouts.admin')

@section('page_title', 'Tambah Foto')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.galleries.index') }}" class="text-[#0a1435] hover:text-brand-primary font-bold text-sm uppercase tracking-wider transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="block">
        @csrf
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Main Content Area -->
            <div class="xl:col-span-8 space-y-6">
                <!-- Title & Description -->
                <div class="card p-6 space-y-6">
                    <div>
                        <label class="form-label" for="title">Judul *</label>
                        <input type="text" name="title" id="title" class="form-input @error('title') border-red-500 @enderror" placeholder="Masukkan judul foto..." value="{{ old('title') }}" required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label" for="description">Deskripsi</label>
                        <textarea name="description" id="description" rows="5" class="form-input @error('description') border-red-500 @enderror" placeholder="Deskripsi foto (opsional)...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Right Column: Settings Area -->
            <div class="xl:col-span-4">
                <div class="space-y-6 sticky top-6">
                    <!-- Media Card -->
                    <div class="card p-6">
                        <h3 class="text-sm font-bold text-[#0a1435] mb-4 pb-2 border-b border-[#0a1435] uppercase tracking-wider mt-0">Media</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="form-label" for="image">Upload Gambar *</label>
                                <input type="file" name="image" id="image" class="form-input @error('image') border-red-500 @enderror" accept="image/*" required>
                                @error('image')
                                    <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                                @enderror
                                <p class="text-xs font-bold text-gray-500 mt-2 uppercase tracking-wider">PNG, JPG, GIF up to 2MB</p>
                                <p id="image-warning" class="text-xs font-bold mt-1 uppercase tracking-wider hidden"></p>
                            </div>
                            <div class="pt-4 border-t border-[#0a1435] flex gap-3">
                                <button type="submit" class="w-full btn-primary py-3">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/compressorjs@1.2.1/dist/compressor.min.js"></script>
<script>
    const imageInput = document.getElementById('image');
    const imageWarning = document.getElementById('image-warning');
    const submitBtn = document.querySelector('button[type="submit"]');

    if (imageInput) {
        imageInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            
            if (!file) {
                if (imageWarning) imageWarning.classList.add('hidden');
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                imageWarning.textContent = `Ukuran asli ${(file.size / 1024 / 1024).toFixed(2)}MB. Sedang mengompresi...`;
                imageWarning.classList.remove('hidden', 'text-red-500', 'text-green-500');
                imageWarning.classList.add('text-orange-500');
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');

                new Compressor(file, {
                    quality: 0.8,
                    maxWidth: 1920,
                    maxHeight: 1920,
                    success(result) {
                        if (result.size > 2 * 1024 * 1024) {
                            imageWarning.textContent = `Gagal! Setelah dikompresi ukuran masih ${(result.size / 1024 / 1024).toFixed(2)}MB (>2MB). Harap ganti gambar.`;
                            imageWarning.classList.remove('text-orange-500', 'text-green-500');
                            imageWarning.classList.add('text-red-500');
                        } else {
                            imageWarning.textContent = `Sukses! Dikompresi menjadi ${(result.size / 1024).toFixed(0)}KB. Aman diunggah.`;
                            imageWarning.classList.remove('text-orange-500', 'text-red-500');
                            imageWarning.classList.add('text-green-500');
                            submitBtn.disabled = false;
                            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                            
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(new File([result], result.name || 'image.jpg', { type: result.type }));
                            imageInput.files = dataTransfer.files;
                        }
                    },
                    error(err) {
                        console.error(err.message);
                        imageWarning.textContent = 'Gagal mengompresi gambar.';
                        imageWarning.classList.remove('text-orange-500', 'text-green-500');
                        imageWarning.classList.add('text-red-500');
                    },
                });
            } else {
                if (imageWarning) imageWarning.classList.add('hidden');
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }
        });
    }
</script>
@endsection
