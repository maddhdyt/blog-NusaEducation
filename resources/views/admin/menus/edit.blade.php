@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Menu</h1>
    </div>

    <div class="card p-6">
        <form action="{{ route('admin.menus.update', $menu) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Title *</label>
                <input type="text" name="title" value="{{ old('title', $menu->title) }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white @error('title') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    required>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Type *</label>
                <select name="url_type" id="menuType"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white @error('url_type') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    required>
                    <option value="page" {{ old('url_type', $menu->url_type) == 'page' ? 'selected' : '' }}>Page</option>
                    <option value="category" {{ old('url_type', $menu->url_type) == 'category' ? 'selected' : '' }}>Category
                    </option>
                    <option value="custom" {{ old('url_type', $menu->url_type) == 'custom' ? 'selected' : '' }}>Custom URL
                    </option>
                </select>
                @error('url_type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2" id="pageField">
                <label class="block text-sm font-semibold text-gray-800">Select Page</label>
                <select name="page_id"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white">
                    <option value="">- Select Page -</option>
                    @foreach ($pages as $page)
                        <option value="{{ $page->id }}"
                            {{ old('page_id', $menu->page_id) == $page->id ? 'selected' : '' }}>{{ $page->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2" id="categoryField" style="display: none;">
                <label class="block text-sm font-semibold text-gray-800">Select Category</label>
                <select name="category_id"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white">
                    <option value="">- Select Category -</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $menu->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2" id="urlField" style="display: none;">
                <label class="block text-sm font-semibold text-gray-800">Custom URL</label>
                <input type="text" name="custom_url" value="{{ old('custom_url', $menu->custom_url) }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="https://example.com">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Slug (optional)</label>
                <input type="text" name="slug" value="{{ old('slug', $menu->slug) }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Leave blank to auto-generate">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Parent Menu</label>
                <select name="parent_id"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white">
                    <option value="">- None (Top Level) -</option>
                    @foreach ($parentMenus as $parentMenu)
                        @if ($parentMenu->id != $menu->id)
                            <option value="{{ $parentMenu->id }}"
                                {{ old('parent_id', $menu->parent_id) == $parentMenu->id ? 'selected' : '' }}>
                                {{ $parentMenu->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Order</label>
                <input type="number" name="order" value="{{ old('order', $menu->order) }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    min="0">
            </div>

            <div class="pt-1">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1"
                        {{ old('is_active', $menu->is_active) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-800">Active</span>
                </label>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn-primary">Update Menu</button>
                <a href="{{ route('admin.menus.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        const typeSelect = document.getElementById('menuType');
        const toggleFields = () => {
            const type = typeSelect.value;
            document.getElementById('pageField').style.display = type === 'page' ? 'block' : 'none';
            document.getElementById('categoryField').style.display = type === 'category' ? 'block' : 'none';
            document.getElementById('urlField').style.display = type === 'custom' ? 'block' : 'none';
        };

        typeSelect.addEventListener('change', toggleFields);
        toggleFields();
    </script>
@endsection
