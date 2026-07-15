@extends('layouts.admin')

@section('page_title', 'Gallery')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Gallery</h1>
        <a href="{{ route('admin.galleries.create') }}" class="btn-primary">Tambah Foto</a>
    </div>

    <div class="card p-4">
        @if ($items->isEmpty())
            <p class="text-gray-600">Belum ada foto.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($items as $item)
                    <div class="rounded-lg border border-gray-200 bg-white overflow-hidden shadow-sm">
                        <div class="aspect-[4/3] bg-gray-100 overflow-hidden">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4 space-y-2">
                            <h3 class="text-base font-semibold text-gray-900">{{ $item->title }}</h3>
                            @if ($item->description)
                                <p class="text-sm text-gray-600 line-clamp-2">{{ $item->description }}</p>
                            @endif
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>{{ $item->created_at->format('d M Y') }}</span>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.galleries.edit', $item) }}"
                                        class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST"
                                        onsubmit="return confirm('Hapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $items->links() }}
            </div>
        @endif
    </div>
@endsection
