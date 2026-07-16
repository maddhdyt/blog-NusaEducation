@extends('layouts.frontend')

@section('content')
    <div class="bg-[#FDF6F0] py-16 lg:py-24">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="flex flex-col gap-12">
                
                {{-- Header Section --}}
                <div class="space-y-6">
                    <p class="text-[11px] font-bold text-brand-primary uppercase tracking-widest font-mono">Kategori</p>
                    <h1 class="text-5xl sm:text-6xl lg:text-[5rem] font-normal text-faux-medium text-[#0a1435] font-heading leading-tight">{{ $category->name }}</h1>
                    @if ($category->description)
                        <p class="text-xl text-[#6b5b59] leading-relaxed max-w-4xl">{{ $category->description }}</p>
                    @endif
                </div>

                {{-- Category Filters --}}
                <div class="flex flex-wrap gap-4 border-b border-[#e2d5cf] pb-8">
                    @foreach ($allCategories as $item)
                        <a href="{{ route('categories.show', $item->slug) }}"
                            class="px-5 py-2 text-[11px] font-bold uppercase tracking-widest font-mono transition border
                            {{ $category->id === $item->id ? 'bg-[#0a1435] border-[#0a1435] text-[#FDF6F0]' : 'bg-transparent border-[#e2d5cf] text-[#0a1435] hover:bg-[#0a1435] hover:text-[#FDF6F0] hover:border-[#0a1435]' }}">
                            {{ $item->name }}
                        </a>
                    @endforeach
                </div>

                {{-- Article List --}}
                <div class="divide-y divide-[#e2d5cf]">
                    @forelse ($posts as $post)
                        <article class="flex flex-col sm:flex-row gap-8 py-10 group">
                            <div class="w-full sm:w-64 h-64 sm:h-48 flex-shrink-0 overflow-hidden border border-[#e2d5cf]">
                                @if ($post->thumbnail_url)
                                    <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                @else
                                    <div class="w-full h-full bg-[#0a1435] group-hover:scale-105 transition duration-700 flex items-center justify-center text-3xl font-bold text-[#FDF6F0] font-heading">
                                        {{ Str::upper(Str::substr($post->title, 0, 1)) }}
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1 flex flex-col justify-center space-y-4">
                                <div class="flex flex-wrap items-center gap-3 text-[11px] font-mono tracking-widest uppercase text-[#735A56]">
                                    <span>{{ optional($post->published_at)->translatedFormat('d M Y') }}</span>
                                    <span>&middot;</span>
                                    <span class="font-bold text-[#0a1435]">{{ $category->name }}</span>
                                </div>

                                <h2 class="text-3xl sm:text-4xl font-normal text-faux-medium text-[#0a1435] font-heading leading-snug group-hover:text-brand-primary transition">
                                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                </h2>

                                <p class="text-[#6b5b59] text-lg leading-relaxed max-w-3xl">
                                    {{ Str::limit($post->excerpt ?: strip_tags($post->content), 180) }}
                                </p>

                                <div class="flex items-center gap-6 pt-2">
                                    <div class="flex items-center gap-3 text-[11px] font-mono tracking-widest uppercase text-[#0a1435]">
                                        <div class="h-8 w-8 overflow-hidden border border-[#e2d5cf] flex items-center justify-center bg-transparent font-bold">
                                            {{ Str::upper(Str::substr($post->user->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold">Oleh {{ $post->user->name ?? 'Unknown' }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('posts.show', $post->slug) }}"
                                        class="inline-flex items-center gap-2 text-[11px] font-bold uppercase tracking-widest font-mono text-[#0a1435] hover:text-brand-primary transition">
                                        Baca Artikel
                                        <span aria-hidden="true" class="text-lg leading-none">&rarr;</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="py-20 text-center">
                            <p class="text-2xl font-normal text-faux-medium text-[#0a1435] font-heading">Belum ada postingan di kategori ini.</p>
                            <p class="text-[#6b5b59] mt-2 font-mono text-sm tracking-widest">Silakan kembali lagi nanti.</p>
                        </div>
                    @endforelse
                </div>

                @if ($posts->hasPages())
                    <div class="flex justify-center pt-8 border-t border-[#e2d5cf]">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
