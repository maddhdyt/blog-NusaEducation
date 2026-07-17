@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.posts.create') }}" class="btn-primary flex items-center gap-2 px-6 py-2.5 text-sm uppercase tracking-wider">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tulis Artikel Baru
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1 -->
        <div class="bg-[#ffccb0] border border-[#0a1435] rounded-none p-6 group transition-transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[#0a1435] text-sm font-semibold tracking-wide uppercase mb-1">Total Menus</p>
                    <p class="text-4xl font-heading text-[#0a1435]">{{ $stats['menus'] }}</p>
                </div>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-[#b5dbff] border border-[#0a1435] rounded-none p-6 group transition-transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[#0a1435] text-sm font-semibold tracking-wide uppercase mb-1">Total Pages</p>
                    <p class="text-4xl font-heading text-[#0a1435]">{{ $stats['pages'] }}</p>
                </div>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-[#b4f3b4] border border-[#0a1435] rounded-none p-6 group transition-transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[#0a1435] text-sm font-semibold tracking-wide uppercase mb-1">Categories</p>
                    <p class="text-4xl font-heading text-[#0a1435]">{{ $stats['categories'] }}</p>
                </div>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-[#ffe499] border border-[#0a1435] rounded-none p-6 group transition-transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[#0a1435] text-sm font-semibold tracking-wide uppercase mb-1">Total Posts</p>
                    <p class="text-4xl font-heading text-[#0a1435]">{{ $stats['posts'] }}</p>
                    <p class="text-xs font-semibold text-[#0a1435]/70 mt-1">{{ $stats['published_posts'] }} published &middot; {{ $stats['draft_posts'] }} drafts</p>
                </div>
            </div>
        </div>

        <!-- Stat Card 5 (Views) -->
        <div class="bg-[#e6d0ff] border border-[#0a1435] rounded-none p-6 group transition-transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[#0a1435] text-sm font-semibold tracking-wide uppercase mb-1">Total Views</p>
                    <p class="text-4xl font-heading text-[#0a1435]">{{ number_format($stats['views']) }}</p>
                </div>
            </div>
        </div>

        <!-- Stat Card 6 (Users) -->
        <div class="bg-[#ffcce6] border border-[#0a1435] rounded-none p-6 group transition-transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[#0a1435] text-sm font-semibold tracking-wide uppercase mb-1">Total Users</p>
                    <p class="text-4xl font-heading text-[#0a1435]">{{ $stats['users'] }}</p>
                </div>
            </div>
        </div>

        <!-- Stat Card 7 (Subscribers) -->
        <div class="bg-[#ffe0b2] border border-[#0a1435] rounded-none p-6 group transition-transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[#0a1435] text-sm font-semibold tracking-wide uppercase mb-1">Subscribers</p>
                    <p class="text-4xl font-heading text-[#0a1435]">{{ $stats['subscribers'] }}</p>
                </div>
            </div>
        </div>

        <!-- Stat Card 8 (Galleries) -->
        <div class="bg-[#b2ebf2] border border-[#0a1435] rounded-none p-6 group transition-transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[#0a1435] text-sm font-semibold tracking-wide uppercase mb-1">Galleries</p>
                    <p class="text-4xl font-heading text-[#0a1435]">{{ $stats['galleries'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-8">
        <!-- Views Chart -->
        <div class="card bg-white flex flex-col p-6">
            <h2 class="text-xl font-heading font-bold text-[#0a1435] tracking-tight mb-4 uppercase">Top 7 Artikel</h2>
            <div class="relative flex-1 w-full" style="min-h: 300px;">
                <canvas id="viewsChart"></canvas>
            </div>
        </div>

        <!-- Categories Chart -->
        <div class="card bg-white flex flex-col p-6">
            <h2 class="text-xl font-heading font-bold text-[#0a1435] tracking-tight mb-4 uppercase">Distribusi Kategori</h2>
            <div class="relative flex-1 w-full flex items-center justify-center" style="min-h: 300px;">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- No Quick Actions -->

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mt-8">
        <!-- Recent Posts Table -->
        <div class="card bg-white flex flex-col">
            <div class="px-6 py-5 border-b border-[#0a1435] flex items-center justify-between">
                <h2 class="text-xl font-heading font-bold text-[#0a1435] tracking-tight">Postingan Terbaru</h2>
                <a href="{{ route('admin.posts.index') }}" class="text-sm font-bold uppercase tracking-wider text-[#0a1435] hover:underline transition-colors">Semua &rarr;</a>
            </div>
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#FDF6F0]">
                            <th class="py-3 px-4 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Artikel</th>
                            <th class="py-3 px-4 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Status</th>
                            <th class="py-3 px-4 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435] text-right">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#0a1435]/10">
                        @forelse ($recentPosts as $post)
                            <tr class="hover:bg-[#FDF6F0] transition-colors group">
                                <td class="py-3 px-4">
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="font-bold text-[#0a1435] hover:underline transition-colors block truncate w-48">
                                        {{ $post->title }}
                                    </a>
                                </td>
                                <td class="py-3 px-4">
                                    @if ($post->status === 'published')
                                        <span class="inline-flex items-center px-2 py-1 border border-[#0a1435] bg-[#b4f3b4] text-[#0a1435] text-[10px] font-bold uppercase tracking-wider">
                                            Published
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 border border-[#0a1435] bg-[#ffe499] text-[#0a1435] text-[10px] font-bold uppercase tracking-wider">
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-[11px] font-bold uppercase tracking-wider text-[#0a1435]/60 text-right">{{ $post->created_at->format('d M y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-8 text-center text-sm font-medium text-gray-500">
                                    Belum ada postingan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Popular Posts -->
        <div class="card bg-white flex flex-col">
            <div class="px-6 py-5 border-b border-[#0a1435] flex items-center justify-between">
                <h2 class="text-xl font-heading font-bold text-[#0a1435] tracking-tight">Artikel Terpopuler</h2>
                <span class="text-sm font-bold uppercase tracking-wider text-[#0a1435]/60">Berdasarkan Views</span>
            </div>
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#FDF6F0]">
                            <th class="py-3 px-4 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Artikel</th>
                            <th class="py-3 px-4 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435] text-right">Views</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#0a1435]/10">
                        @forelse ($popularPosts as $post)
                            <tr class="hover:bg-[#FDF6F0] transition-colors group">
                                <td class="py-3 px-4">
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="font-bold text-[#0a1435] hover:underline transition-colors block truncate w-64">
                                        {{ $post->title }}
                                    </a>
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <span class="inline-flex items-center gap-1 font-bold text-[#0a1435]">
                                        {{ number_format($post->views) }}
                                        <svg class="w-4 h-4 text-[#0a1435]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="py-8 text-center text-sm font-medium text-gray-500">
                                    Belum ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#0a1435';
    Chart.defaults.scale.grid.color = 'rgba(10, 20, 53, 0.1)';
    
    // Views Chart
    const viewsCtx = document.getElementById('viewsChart').getContext('2d');
    new Chart(viewsCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($viewsChartData['labels']) !!},
            datasets: [{
                label: 'Total Views',
                data: {!! json_encode($viewsChartData['data']) !!},
                backgroundColor: '#b5dbff',
                borderColor: '#0a1435',
                borderWidth: 2,
                borderRadius: 0,
                hoverBackgroundColor: '#ffe499',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, border: { color: '#0a1435', width: 2 } },
                x: { border: { color: '#0a1435', width: 2 } }
            }
        }
    });

    // Category Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [{
                data: {!! json_encode($chartData['data']) !!},
                backgroundColor: ['#ffccb0', '#b5dbff', '#b4f3b4', '#ffe499', '#e6d0ff', '#ffcce6', '#ffe0b2'],
                borderColor: '#0a1435',
                borderWidth: 2,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right', labels: { font: { weight: 'bold' } } }
            },
            layout: { padding: 20 }
        }
    });
});
</script>
@endpush
