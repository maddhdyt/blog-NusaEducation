@extends('layouts.admin')

@section('page_title', 'Edit Foto')

@section('content')
    <div class="max-w-3xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Foto</h1>
            <a href="{{ route('admin.galleries.index') }}" class="text-sm text-gray-600 hover:text-blue-600">Kembali</a>
        </div>

        <div class="card p-6 space-y-6">
            <form action="{{ route('admin.galleries.update', $item) }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="form-label" for="title">Judul</label>
                    <input type="text" name="title" id="title" class="form-input"
                        value="{{ old('title', $item->title) }}" required>
                </div>

                <div>
                    <label class="form-label" for="description">Deskripsi</label>
                    <textarea name="description" id="description" rows="3" class="form-input">{{ old('description', $item->description) }}</textarea>
                </div>

                <div class="space-y-2">
                    <label class="form-label" for="image">Upload Gambar</label>
                    <input type="file" name="image" id="image" class="form-input" accept="image/*">
                    <p class="text-xs text-gray-500">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                    <div class="aspect-[4/3] w-64 bg-gray-100 overflow-hidden rounded">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn-primary">Simpan</button>
                    <a href="{{ route('admin.galleries.index') }}" class="btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
