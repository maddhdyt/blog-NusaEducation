@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1 (Peach) -->
        <div class="bg-[#ffccb0] border border-[#0a1435] rounded-none p-6 group transition-transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[#0a1435] text-sm font-semibold tracking-wide uppercase mb-1">Total Menus</p>
                    <p class="text-4xl font-heading text-[#0a1435]">{{ $stats['menus'] }}</p>
                </div>
            </div>
        </div>

        <!-- Stat Card 2 (Blue) -->
        <div class="bg-[#b5dbff] border border-[#0a1435] rounded-none p-6 group transition-transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[#0a1435] text-sm font-semibold tracking-wide uppercase mb-1">Total Pages</p>
                    <p class="text-4xl font-heading text-[#0a1435]">{{ $stats['pages'] }}</p>
                </div>
            </div>
        </div>

        <!-- Stat Card 3 (Green) -->
        <div class="bg-[#b4f3b4] border border-[#0a1435] rounded-none p-6 group transition-transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[#0a1435] text-sm font-semibold tracking-wide uppercase mb-1">Categories</p>
                    <p class="text-4xl font-heading text-[#0a1435]">{{ $stats['categories'] }}</p>
                </div>
            </div>
        </div>

        <!-- Stat Card 4 (Yellow) -->
        <div class="bg-[#ffe499] border border-[#0a1435] rounded-none p-6 group transition-transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[#0a1435] text-sm font-semibold tracking-wide uppercase mb-1">Total Posts</p>
                    <p class="text-4xl font-heading text-[#0a1435]">{{ $stats['posts'] }}</p>
                    <p class="text-xs font-semibold text-[#0a1435]/70 mt-1">{{ $stats['published_posts'] }} published &middot; {{ $stats['draft_posts'] }} drafts</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Posts Table -->
    <div class="card bg-white mt-8">
        <div class="px-6 py-5 border-b border-[#0a1435] flex items-center justify-between">
            <h2 class="text-xl font-heading font-bold text-[#0a1435] tracking-tight">Postingan Terbaru</h2>
            <a href="{{ route('admin.posts.index') }}" class="text-sm font-bold uppercase tracking-wider text-[#0a1435] hover:underline transition-colors">Lihat Semua &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#FDF6F0]">
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Judul Artikel</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Kategori</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Penulis</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Status</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435] text-right">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#0a1435]/10">
                    @forelse ($recentPosts as $post)
                        <tr class="hover:bg-[#FDF6F0] transition-colors group">
                            <td class="py-4 px-6">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="font-bold text-[#0a1435] hover:underline transition-colors">
                                    {{ $post->title }}
                                </a>
                            </td>
                            <td class="py-4 px-6 text-sm text-[#0a1435]">
                                <span class="inline-flex items-center px-2 py-1 border border-[#0a1435] bg-white text-xs font-bold uppercase">
                                    {{ $post->category->name }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-sm text-[#0a1435] font-semibold">{{ $post->user->name }}</td>
                            <td class="py-4 px-6">
                                @if ($post->status === 'published')
                                    <span class="inline-flex items-center px-2 py-1 border border-[#0a1435] bg-[#b4f3b4] text-[#0a1435] text-xs font-bold uppercase">
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 border border-[#0a1435] bg-[#ffe499] text-[#0a1435] text-xs font-bold uppercase">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-sm font-semibold text-[#0a1435] text-right">{{ $post->created_at->format('d M, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <p class="mt-4 text-sm font-medium text-gray-500">Belum ada postingan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
