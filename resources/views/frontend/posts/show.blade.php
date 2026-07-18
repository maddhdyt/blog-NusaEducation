@extends('layouts.frontend')

@section('meta_description')
{{ $post->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 160) }}
@endsection

@section('og_type', 'article')

@if($post->thumbnail)
@section('og_image')
{{ asset('storage/' . $post->thumbnail) }}
@endsection
@endif

@section('structured_data')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Article",
  "headline": "{{ $post->title }}",
  "image": [
    "{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : '' }}"
   ],
  "datePublished": "{{ optional($post->published_at)->toIso8601String() }}",
  "dateModified": "{{ $post->updated_at->toIso8601String() }}",
  "author": [{
      "@@type": "Person",
      "name": "{{ $post->user->name ?? 'Admin' }}"
  }]
}
</script>
@endsection
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
    <style>
        .quill-content {
            color: #433836;
            font-size: 1.0625rem; /* 17px for mobile */
            line-height: 1.7;
        }
        @media (min-width: 768px) {
            .quill-content {
                font-size: 1.25rem; /* 20px for desktop */
                line-height: 1.8;
            }
        }
        .quill-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0;
            margin: 3rem 0;
            border: 1px solid #e2d5cf;
        }
        .quill-content iframe {
            width: 100%;
            min-height: 400px;
            margin: 3rem 0;
        }
        .quill-content a {
            color: #0a1435;
            text-decoration: underline;
            text-underline-offset: 4px;
            font-weight: 600;
        }
        .quill-content a:hover {
            color: #1786F8;
        }
        .quill-content h2, .quill-content h3, .quill-content h4 {
            color: #0a1435;
            font-family: 'Feature', serif;
            font-weight: 500;
            margin-top: 3rem;
            margin-bottom: 1.25rem;
        }
        .quill-content h2 { font-size: 1.75rem; }
        .quill-content h3 { font-size: 1.5rem; }
        @media (min-width: 768px) {
            .quill-content h2 { font-size: 2.5rem; }
            .quill-content h3 { font-size: 1.875rem; }
        }
        .quill-content ul {
            list-style: disc;
            padding-left: 1.5rem;
            margin: 1.5rem 0;
        }
        .quill-content ol {
            list-style: decimal;
            padding-left: 1.5rem;
            margin: 1.5rem 0;
        }
        .quill-content blockquote {
            border-left: 4px solid #0a1435;
            padding-left: 1.5rem;
            margin: 2rem 0;
            color: #6b5b59;
            font-style: italic;
            font-size: 1.25rem;
            line-height: 1.6;
        }
        @media (min-width: 768px) {
            .quill-content blockquote {
                padding-left: 2rem;
                margin: 2.5rem 0;
                font-size: 1.5rem;
            }
        }
        .quill-content pre {
            background: #0a1435;
            color: #FDF6F0;
            padding: 1.5rem;
            border-radius: 0;
            overflow: auto;
            margin: 2rem 0;
            font-family: monospace;
            font-size: 1rem;
        }
    </style>

    <div class="bg-[#FDF6F0]">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 py-12 lg:py-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-0">
                
                <!-- Main Article Column -->
                <article class="lg:col-span-8 xl:col-span-9 lg:pr-12 xl:pr-20">
                    <nav class="flex flex-wrap items-center gap-2 text-[11px] font-mono tracking-widest uppercase text-[#735A56] mb-10">
                        <a href="{{ route('home') }}" class="hover:text-[#0a1435] transition">Home</a>
                        <span>/</span>
                        @if (!empty($post->category))
                            <a href="{{ route('categories.show', $post->category->slug) }}"
                                class="hover:text-[#0a1435] transition">{{ $post->category->name }}</a>
                            <span>/</span>
                        @endif
                        <span class="font-bold text-[#0a1435]">{{ $post->title }}</span>
                    </nav>

                    <div class="space-y-8 max-w-[900px]">
                        <h1 class="text-3xl sm:text-4xl lg:text-[4rem] font-normal text-faux-medium leading-normal text-[#0a1435] font-heading">
                            {{ $post->title }}
                        </h1>

                        @if ($post->excerpt)
                            <p class="text-base sm:text-lg lg:text-xl text-[#6b5b59] leading-relaxed">{{ $post->excerpt }}</p>
                        @endif

                        <div class="flex flex-wrap items-center gap-4 text-[11px] font-mono uppercase tracking-widest text-[#735A56] border-y border-[#e2d5cf] py-6">
                            @if (!empty($post->category))
                                <a href="{{ route('categories.show', $post->category->slug) }}"
                                    class="border border-[#0a1435] px-4 py-1.5 font-bold text-[#0a1435] hover:bg-[#0a1435] hover:text-[#FDF6F0] transition">
                                    {{ $post->category->name }}
                                </a>
                            @endif
                            <span class="hidden sm:inline">&middot;</span>
                            <span>{{ optional($post->published_at ?? $post->created_at)->translatedFormat('d M Y') }}</span>
                            <span class="hidden sm:inline">&middot;</span>
                            <span class="flex items-center gap-2">
                                <img src="{{ $post->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name ?? 'Author') . '&background=0a1435&color=FDF6F0' }}"
                                alt="{{ $post->user->name ?? 'Author' }}" class="h-6 w-6 mix-blend-multiply" />
                                Oleh <span class="font-bold text-[#0a1435]">{{ $post->user->name ?? 'Admin' }}</span>
                            </span>
                            <span class="hidden sm:inline">&middot;</span>
                            <span class="flex items-center gap-1.5" title="Jumlah Kunjungan">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                {{ number_format($post->views) }} Views
                            </span>
                        </div>
                    </div>

                    @if ($post->thumbnail)
                        <div class="mt-12 mb-16">
                            <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}"
                                class="w-full h-auto max-h-[600px] object-cover border border-[#e2d5cf]">
                        </div>
                    @endif

                    <!-- Article Body -->
                    <div class="mt-12">
                        <div class="quill-content w-full">
                            {!! $post->content !!}
                        </div>
                    </div>

                    <!-- Related Posts -->
                    @if ($relatedPosts->isNotEmpty())
                        <div class="mt-24 pt-16 border-t-2 border-[#0a1435] max-w-[900px]">
                            <h2 class="text-3xl font-normal text-faux-medium text-[#0a1435] font-heading mb-10">Artikel Terkait</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                @foreach ($relatedPosts as $related)
                                    <article class="group">
                                        <div class="aspect-[4/3] overflow-hidden mb-5 border border-[#e2d5cf]">
                                            @if ($related->thumbnail)
                                                <img src="{{ $related->thumbnail_url }}" alt="{{ $related->title }}"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                            @else
                                                <div class="w-full h-full bg-[#0a1435] group-hover:scale-105 transition duration-700"></div>
                                            @endif
                                        </div>
                                        <div class="space-y-3">
                                            <div class="inline-flex items-center gap-2 text-[11px] text-[#735A56] font-mono tracking-widest uppercase">
                                                <span class="font-bold text-[#0a1435]">{{ $related->category->name ?? 'Umum' }}</span>
                                                <span>&middot;</span>
                                                <time>{{ optional($related->published_at ?? $related->created_at)->translatedFormat('d M Y') }}</time>
                                            </div>
                                            <h3 class="text-xl font-normal text-faux-medium text-[#0a1435] font-heading leading-snug group-hover:text-brand-primary transition">
                                                <a href="{{ route('posts.show', $related->slug) }}">{{ $related->title }}</a>
                                            </h3>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </article>

                <!-- Sidebar -->
                <aside class="lg:col-span-4 xl:col-span-3 space-y-12 lg:border-l border-[#e2d5cf] lg:pl-10 xl:pl-12">
                    
                    {{-- Author Profile Widget --}}
                    <div class="space-y-6">
                        <div class="border-b border-[#0a1435] pb-2">
                            <p class="text-[11px] font-bold uppercase tracking-widest text-[#0a1435] font-mono">Profil Penulis</p>
                        </div>
                        <div class="flex items-center gap-4">
                            @php
                                $avatar = optional($sidebar)->author_avatar_url ?:
                                    'https://ui-avatars.com/api/?name=' . urlencode(optional($sidebar)->author_name ?? ($post->user->name ?? 'Author')) . '&background=0a1435&color=FDF6F0';
                            @endphp
                            <img src="{{ $avatar }}"
                                alt="{{ optional($sidebar)->author_name ?? ($post->user->name ?? 'Author') }}"
                                class="h-16 w-16 mix-blend-multiply border border-[#e2d5cf] p-1 object-cover" />
                            <div>
                                <p class="text-lg font-bold text-[#0a1435] font-sans">
                                    {{ optional($sidebar)->author_name ?? ($post->user->name ?? 'Author') }}
                                </p>
                                <p class="text-[11px] text-[#735A56] font-mono tracking-widest uppercase mt-1">
                                    {{ optional($sidebar)->author_role ?? 'Kontributor' }}
                                </p>
                            </div>
                        </div>
                        <p class="text-[15px] text-[#6b5b59] leading-relaxed">
                            {{ optional($sidebar)->author_bio ?? 'Ikuti akun kami untuk update terbaru seputar strategi digital dan artikel inspiratif.' }}
                        </p>
                        <div class="flex flex-wrap gap-3">
                            @if (optional($sidebar)->author_tiktok_url)
                                <a href="{{ optional($sidebar)->author_tiktok_url }}"
                                    class="border border-[#e2d5cf] hover:border-[#0a1435] hover:bg-[#0a1435] hover:text-[#FDF6F0] px-4 py-2 text-[11px] font-bold uppercase tracking-widest font-mono text-[#0a1435] transition">TikTok</a>
                            @endif
                            @if (optional($sidebar)->author_youtube_url)
                                <a href="{{ optional($sidebar)->author_youtube_url }}"
                                    class="border border-[#e2d5cf] hover:border-[#0a1435] hover:bg-[#0a1435] hover:text-[#FDF6F0] px-4 py-2 text-[11px] font-bold uppercase tracking-widest font-mono text-[#0a1435] transition">YouTube</a>
                            @endif
                            @if (optional($sidebar)->author_newsletter_url)
                                <a href="{{ optional($sidebar)->author_newsletter_url }}"
                                    class="border border-[#e2d5cf] hover:border-[#0a1435] hover:bg-[#0a1435] hover:text-[#FDF6F0] px-4 py-2 text-[11px] font-bold uppercase tracking-widest font-mono text-[#0a1435] transition">Newsletter</a>
                            @endif
                        </div>
                    </div>

                    {{-- Trending Widget --}}
                    <div class="space-y-6">
                        <div class="border-b border-[#0a1435] pb-2 flex items-center justify-between">
                            <p class="text-[11px] font-bold uppercase tracking-widest text-[#0a1435] font-mono">
                                {{ optional($sidebar)->trending_title ?? 'Sedang Tren' }}
                            </p>
                            @if (optional($sidebar)->trending_link_url && optional($sidebar)->trending_link_text)
                                <a href="{{ optional($sidebar)->trending_link_url }}"
                                    class="text-[11px] font-bold uppercase tracking-widest text-brand-primary hover:text-[#0a1435] font-mono transition">
                                    {{ optional($sidebar)->trending_link_text }}
                                </a>
                            @endif
                        </div>
                        <div class="space-y-4">
                            {{-- Add actual trending loop here if variable exists, otherwise fallback --}}
                            <p class="text-[15px] text-[#6b5b59]">Belum ada artikel tren minggu ini.</p>
                        </div>
                    </div>

                    {{-- CTA Widget --}}
                    <div class="bg-[#0a1435] text-[#FDF6F0] p-8 space-y-6">
                        @if (optional($sidebar)->cta_badge)
                            <p class="text-[11px] font-bold uppercase tracking-widest text-brand-primary font-mono">
                                {{ optional($sidebar)->cta_badge }}
                            </p>
                        @endif
                        @if (optional($sidebar)->cta_title)
                            <h3 class="text-3xl font-normal text-faux-medium font-heading leading-tight">{{ optional($sidebar)->cta_title }}</h3>
                        @endif
                        @if (optional($sidebar)->cta_subtitle)
                            <p class="text-[15px] text-[#e2d5cf] opacity-90 leading-relaxed">{{ optional($sidebar)->cta_subtitle }}</p>
                        @endif
                        <div class="pt-4 space-y-4">
                            @if (optional($sidebar)->cta_primary_text && optional($sidebar)->cta_primary_url)
                                <a href="{{ optional($sidebar)->cta_primary_url }}"
                                    class="block w-full border border-transparent bg-brand-primary hover:bg-white hover:text-[#0a1435] px-6 py-4 text-center text-[12px] font-bold uppercase tracking-widest font-mono transition">
                                    {{ optional($sidebar)->cta_primary_text }}
                                </a>
                            @endif
                            @if (optional($sidebar)->cta_secondary_text && optional($sidebar)->cta_secondary_url)
                                <a href="{{ optional($sidebar)->cta_secondary_url }}"
                                    class="block w-full border border-[#FDF6F0] bg-transparent hover:bg-[#FDF6F0] hover:text-[#0a1435] px-6 py-4 text-center text-[12px] font-bold uppercase tracking-widest font-mono transition">
                                    {{ optional($sidebar)->cta_secondary_text }}
                                </a>
                            @endif
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </div>
@endsection
