@extends('layouts.admin')

@section('page_title', 'Gallery')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-heading font-bold text-[#0a1435] tracking-tight">Galeri Foto</h2>
        <a href="{{ route('admin.galleries.create') }}" class="inline-flex items-center px-4 py-2 bg-[#0a1435] border border-[#0a1435] text-white text-sm font-bold uppercase tracking-wider hover:bg-[#FDF6F0] hover:text-[#0a1435] transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Foto
        </a>
    </div>

    <div class="card bg-white p-6 border border-[#0a1435] rounded-none shadow-none">
        @if ($items->isEmpty())
            <p class="text-[#0a1435] font-semibold text-center py-8">Belum ada foto.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($items as $item)
                    <div class="border border-[#0a1435] bg-white group">
                        <div class="aspect-[4/3] bg-[#FDF6F0] overflow-hidden border-b border-[#0a1435]">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform group-hover:scale-105 duration-300">
                        </div>
                        <div class="p-4 space-y-3">
                            <h3 class="text-base font-bold text-[#0a1435]">{{ $item->title }}</h3>
                            @if ($item->description)
                                <p class="text-sm text-[#0a1435]/70 line-clamp-2 font-medium">{{ $item->description }}</p>
                            @endif
                            <div class="flex items-center justify-between text-xs text-[#0a1435] font-semibold pt-2 border-t border-[#0a1435]/10 mt-2">
                                <span>{{ $item->created_at->format('d M Y') }}</span>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.galleries.edit', $item) }}"
                                        class="hover:underline font-bold uppercase">Edit</a>
                                    <span class="text-[#0a1435]/30">|</span>
                                    <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST"
                                        onsubmit="confirmDelete(event, this, 'Hapus Foto?', 'Foto ini akan dihapus permanen!');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline font-bold uppercase">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($items->hasPages())
                <div class="mt-8">
                    {{ $items->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection
