@extends('layouts.frontend')

@section('content')
    @php
        $searchQuery = $searchQuery ?? request('q', '');
        $hasQuery = $searchQuery !== '';
    @endphp

    <div class="bg-[#FDF6F0] min-h-screen py-16 lg:py-24">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
                
                {{-- Left Sidebar --}}
                <aside class="lg:col-span-3 space-y-12">
                    <div>
                        <h1 class="text-4xl lg:text-5xl font-normal text-faux-medium text-[#0a1435] font-heading leading-tight mb-8">
                            @if ($hasQuery)
                                Pencarian
                            @else
                                Semua Artikel
                            @endif
                        </h1>
                        
                        <form action="{{ route('posts.search') }}" method="GET" class="space-y-4">
                            <div class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-[#0a1435]/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 105 5a7.5 7.5 0 0011.65 11.65z" />
                                </svg>
                                <input type="text" name="q" value="{{ $searchQuery }}" placeholder="Cari artikel..."
                                    class="w-full h-12 bg-white border border-[#e2d5cf] pl-10 pr-4 font-mono text-[13px] text-[#0a1435] focus:outline-none focus:border-brand-primary placeholder:text-[#0a1435]/50 rounded-none shadow-sm">
                            </div>
                            
                            @if ($hasQuery)
                                <a href="{{ route('posts.index') }}" class="w-full h-12 flex items-center justify-center bg-brand-primary text-[#FDF6F0] font-mono text-[13px] font-bold uppercase tracking-widest hover:bg-[#0a1435] transition-colors border border-transparent">
                                    Hapus Filter
                                </a>
                            @endif
                        </form>
                    </div>

                    {{-- Newsletter / Community Widget --}}
                    <div class="bg-white shadow-sm border border-[#e2d5cf] p-8">
                        <h3 class="text-2xl font-heading text-[#0a1435] leading-tight mb-4">Bergabung dengan komunitas kami</h3>
                        <p class="text-sm text-[#6b5b59] mb-6 leading-relaxed">
                            Temukan tips, insight, dan panduan belajar terbaru langsung dari para ahli di Nusa Education.
                        </p>
                        <a href="#" class="inline-flex items-center gap-2 text-[11px] font-bold uppercase tracking-widest text-brand-primary font-mono hover:text-[#0a1435] transition-colors">
                            Langganan <span aria-hidden="true" class="text-lg leading-none">&rarr;</span>
                        </a>
                    </div>
                </aside>

                {{-- Right Content (Post Grid) --}}
                <div class="lg:col-span-9">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 lg:gap-10">
                        @forelse ($posts as $post)
                            <article class="flex flex-col group h-full shadow-sm">
                                <a href="{{ route('posts.show', $post->slug) }}" class="block w-full aspect-[4/3] overflow-hidden bg-[#0a1435] relative">
                                    @if ($post->thumbnail)
                                        <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}"
                                            class="absolute inset-0 h-full w-full object-cover transition duration-1000 group-hover:scale-105 opacity-90 group-hover:opacity-100">
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center opacity-10">
                                            <span class="text-[5rem] font-bold text-[#FDF6F0] font-heading">{{ Str::upper(Str::substr($post->title, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                </a>
                                
                                <div class="flex-1 flex flex-col bg-white p-6 lg:p-8 border-x border-b border-[#e2d5cf]/50">
                                    <h2 class="text-2xl lg:text-3xl font-normal text-faux-medium font-heading text-[#0a1435] leading-snug group-hover:text-brand-primary transition-colors mb-3">
                                        <a href="{{ route('posts.show', $post->slug) }}">
                                            {{ Str::limit($post->title, 70) }}
                                        </a>
                                    </h2>
                                    <p class="text-sm text-[#433836] line-clamp-3 leading-relaxed mb-6">
                                        {{ Str::limit($post->excerpt ?: strip_tags($post->content ?? ''), 150) }}
                                    </p>
                                    <div class="mt-auto flex items-center gap-3 text-[10px] font-mono uppercase tracking-[0.2em] text-[#6b5b59]">
                                        <span>{{ optional($post->published_at ?? $post->created_at)->translatedFormat('d M Y') }}</span>
                                        <span class="text-[#e2d5cf]">|</span>
                                        <span>{{ $post->user->name ?? 'Admin' }}</span>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="col-span-full py-24 text-center bg-white shadow-sm border border-[#e2d5cf]">
                                @if ($hasQuery)
                                    <p class="text-4xl font-heading text-[#0a1435]">Tidak ada hasil untuk "{{ $searchQuery }}"</p>
                                    <p class="text-[#6b5b59] mt-4 font-mono text-[11px] uppercase tracking-widest">Coba kata kunci lain.</p>
                                    <a href="{{ route('posts.index') }}" class="inline-flex items-center justify-center mt-8 px-6 py-3 bg-[#0a1435] text-[#FDF6F0] text-[11px] font-bold uppercase tracking-widest font-mono hover:bg-brand-primary transition-colors">
                                        Lihat semua artikel
                                    </a>
                                @else
                                    <p class="text-4xl font-heading text-[#0a1435]">Belum ada artikel.</p>
                                @endif
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if ($posts->hasPages())
                        <div class="pt-16 mt-8 border-t border-[#e2d5cf]">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
