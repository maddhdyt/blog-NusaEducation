@extends('layouts.admin')

@section('page_title', 'Edit Foto')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.galleries.index') }}" class="text-[#0a1435] hover:text-brand-primary font-bold text-sm uppercase tracking-wider transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.galleries.update', $item) }}" method="POST" enctype="multipart/form-data" class="block">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Main Content Area -->
            <div class="xl:col-span-8 space-y-6">
                <!-- Title & Description -->
                <div class="card p-6 space-y-6">
                    <div>
                        <label class="form-label" for="title">Judul *</label>
                        <input type="text" name="title" id="title" class="form-input @error('title') border-red-500 @enderror" placeholder="Masukkan judul foto..." value="{{ old('title', $item->title) }}" required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label" for="description">Deskripsi</label>
                        <textarea name="description" id="description" rows="5" class="form-input @error('description') border-red-500 @enderror" placeholder="Deskripsi foto (opsional)...">{{ old('description', $item->description) }}</textarea>
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
                                <label class="form-label" for="image">Upload Gambar Baru</label>
                                @if ($item->image)
                                    <div class="mb-4 border border-[#0a1435]">
                                        <img src="{{ $item->image_url }}" alt="Current Image" class="w-full h-auto object-cover block">
                                        <div class="bg-[#FDF6F0] border-t border-[#0a1435] p-2 text-center text-xs font-bold uppercase tracking-wider text-[#0a1435]">Gambar Saat Ini</div>
                                    </div>
                                @endif
                                <input type="file" name="image" id="image" class="form-input @error('image') border-red-500 @enderror" accept="image/*">
                                @error('image')
                                    <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                                @enderror
                                <p class="text-xs font-bold text-gray-500 mt-2 uppercase tracking-wider">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                            </div>
                            <div class="pt-4 border-t border-[#0a1435] flex gap-3">
                                <button type="submit" class="w-full btn-primary py-3">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
