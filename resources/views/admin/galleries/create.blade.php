@extends('layouts.admin')

@section('page_title', 'Tambah Foto')

@section('content')
    <div class="max-w-3xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Foto</h1>
            <a href="{{ route('admin.galleries.index') }}" class="text-sm text-gray-600 hover:text-blue-600">Kembali</a>
        </div>

        <div class="card p-6 space-y-6">
            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="form-label" for="title">Judul</label>
                    <input type="text" name="title" id="title" class="form-input" value="{{ old('title') }}"
                        required>
                </div>

                <div>
                    <label class="form-label" for="description">Deskripsi</label>
                    <textarea name="description" id="description" rows="3" class="form-input">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="form-label" for="image">Upload Gambar</label>
                    <input type="file" name="image" id="image" class="form-input" accept="image/*" required>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn-primary">Simpan</button>
                    <a href="{{ route('admin.galleries.index') }}" class="btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
