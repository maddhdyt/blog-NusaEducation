@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.categories.index') }}" class="text-[#0a1435] hover:text-brand-primary font-bold text-sm uppercase tracking-wider transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="block">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Main Content Area -->
            <div class="xl:col-span-8 space-y-6">
                <!-- Name & Slug -->
                <div class="card p-6 space-y-6">
                    <div>
                        <label class="form-label" for="name">Name *</label>
                        <input type="text" name="name" id="name" class="form-input @error('name') border-red-500 @enderror" placeholder="Masukkan nama kategori..." value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label" for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-input @error('slug') border-red-500 @enderror" value="{{ old('slug', $category->slug) }}" placeholder="Leave blank to auto-generate">
                        @error('slug')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                        <p class="text-xs font-bold text-gray-500 mt-2 uppercase tracking-wider">Leave blank to auto-generate from name</p>
                    </div>
                </div>

                <!-- Description & SEO -->
                <div class="card p-6 space-y-6">
                    <div>
                        <label class="form-label" for="description">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-input @error('description') border-red-500 @enderror" placeholder="Deskripsi kategori...">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label" for="meta_description">Meta Description (SEO)</label>
                        <textarea name="meta_description" id="meta_description" rows="2" class="form-input @error('meta_description') border-red-500 @enderror" placeholder="Meta description for SEO...">{{ old('meta_description', $category->meta_description) }}</textarea>
                        @error('meta_description')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Right Column: Settings Area -->
            <div class="xl:col-span-4">
                <div class="space-y-6 sticky top-6">
                    <!-- Action Card -->
                    <div class="card p-6">
                        <h3 class="text-sm font-bold text-[#0a1435] mb-4 pb-2 border-b border-[#0a1435] uppercase tracking-wider mt-0">Hierarki</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="form-label" for="parent_id">Parent Category</label>
                                <select name="parent_id" id="parent_id" class="form-input">
                                    <option value="">- None (Top Level) -</option>
                                    @foreach ($parentCategories as $parentCategory)
                                        @if ($parentCategory->id != $category->id)
                                            <option value="{{ $parentCategory->id }}"
                                                {{ old('parent_id', $category->parent_id) == $parentCategory->id ? 'selected' : '' }}>
                                                {{ $parentCategory->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="pt-4 border-t border-[#0a1435] flex gap-3">
                                <button type="submit" class="w-full btn-primary py-3">Update Category</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
