@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Category</h1>
    </div>

    <div class="card p-6">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Name *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $category->slug) }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('slug') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    placeholder="Leave blank to auto-generate">
                @error('slug')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500">Leave blank to auto-generate from name</p>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Description</label>
                <textarea name="description" rows="3"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Parent Category</label>
                <select name="parent_id"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white">
                    <option value="">- None (Top Level) -</option>
                    @foreach ($parentCategories as $parentCategory)
                        @if ($parentCategory->id != $category->id)
                            <option value="{{ $parentCategory->id }}"
                                {{ old('parent_id', $category->parent_id) == $parentCategory->id ? 'selected' : '' }}>
                                {{ $parentCategory->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Meta Description</label>
                <textarea name="meta_description" rows="2"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('meta_description') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('meta_description', $category->meta_description) }}</textarea>
                @error('meta_description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn-primary">Update Category</button>
                <a href="{{ route('admin.categories.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
