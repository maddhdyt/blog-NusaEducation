@extends('layouts.frontend')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
    <style>
        .quill-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            margin: 1.25rem 0;
        }

        .quill-content iframe {
            width: 100%;
            min-height: 320px;
            border-radius: 0.75rem;
        }

        .quill-content a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .quill-content a:hover {
            text-decoration: underline;
        }

        .quill-content .ql-align-center {
            text-align: center;
        }

        .quill-content .ql-align-right {
            text-align: right;
        }

        .quill-content .ql-align-justify {
            text-align: justify;
        }

        .quill-content ul {
            list-style: disc;
            padding-left: 1.5rem;
        }

        .quill-content ol {
            list-style: decimal;
            padding-left: 1.5rem;
        }

        .quill-content blockquote {
            border-left: 4px solid #e5e7eb;
            padding-left: 1rem;
            color: #4b5563;
        }

        .quill-content pre {
            background: #0f172a;
            color: #e2e8f0;
            padding: 1rem;
            border-radius: 0.75rem;
            overflow: auto;
        }
    </style>
    <div class="bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="flex flex-col lg:flex-row gap-10 lg:gap-16">
                <article class="lg:flex-1">
                    <nav class="flex flex-wrap items-center gap-2 text-sm text-gray-500 mb-6">
                        <a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a>
                        <span class="text-gray-300">/</span>
                        @if (!empty($post->category))
                            <a href="{{ route('categories.show', $post->category->slug) }}"
                                class="hover:text-indigo-600">{{ $post->category->name }}</a>
                            <span class="text-gray-300">/</span>
                        @endif
                        <span class="font-medium text-gray-900">{{ $post->title }}</span>
                    </nav>

                    <div class="space-y-6">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight text-gray-900">
                            {{ $post->title }}
                        </h1>

                        @if ($post->excerpt)
                            <p class="text-lg sm:text-xl text-gray-600 max-w-3xl">{{ $post->excerpt }}</p>
                        @endif

                        <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500">
                            @if (!empty($post->category))
                                <a href="{{ route('categories.show', $post->category->slug) }}"
                                    class="inline-flex items-center rounded-full border border-gray-200 px-3 py-1 font-semibold text-gray-900 hover:border-indigo-200 hover:text-indigo-700">
                                    {{ $post->category->name }}
                                </a>
                            @endif
                            <span class="text-gray-300">•</span>
                            <span>{{ optional($post->published_at ?? $post->created_at)->translatedFormat('d M Y') }}</span>
                            <span class="text-gray-300">•</span>
                            <span>Oleh {{ $post->user->name ?? 'Admin' }}</span>
                        </div>

                        <div class="flex items-center gap-3">
                            <img src="{{ $post->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name ?? 'Author') . '&background=111827&color=fff' }}"
                                alt="{{ $post->user->name ?? 'Author' }}" class="h-12 w-12 rounded-full bg-gray-100" />
                            <div class="text-sm text-gray-600">
                                <p class="font-semibold text-gray-900">{{ $post->user->name ?? 'Author' }}</p>
                                <p>{{ $post->user->role ?? 'Contributor' }}</p>
                            </div>
                        </div>
                    </div>

                    @if ($post->thumbnail)
                        <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}"
                            class="mt-10 w-full max-h-[480px] object-cover rounded-2xl shadow-lg">
                    @endif

                    <div class="mt-10">
                        <div
                            class="prose prose-lg max-w-none prose-headings:font-semibold prose-a:text-indigo-600 quill-content">
                            {!! $post->content !!}
                        </div>
                    </div>

                    @if ($relatedPosts->isNotEmpty())
                        <div class="mt-16 pt-12 border-t">
                            <h2 class="text-2xl font-bold mb-6">Related Articles</h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach ($relatedPosts as $related)
                                    <article
                                        class="rounded-xl border border-gray-100 bg-white shadow-sm hover:shadow-lg transition">
                                        @if ($related->thumbnail)
                                            <img src="{{ $related->thumbnail_url }}" alt="{{ $related->title }}"
                                                class="w-full h-40 object-cover rounded-t-xl">
                                        @else
                                            <div
                                                class="w-full h-40 rounded-t-xl bg-gradient-to-br from-blue-400 to-blue-600">
                                            </div>
                                        @endif

                                        <div class="p-4">
                                            <h3 class="font-semibold mb-2 text-gray-900 hover:text-indigo-600">
                                                <a
                                                    href="{{ route('posts.show', $related->slug) }}">{{ $related->title }}</a>
                                            </h3>
                                            <p class="text-sm text-gray-500">
                                                {{ optional($related->published_at ?? $related->created_at)->translatedFormat('d M Y') }}
                                            </p>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </article>

                <aside class="lg:w-80 lg:flex-none space-y-6">
                    {{-- Author card --}}
                    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-5 space-y-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-indigo-600">Profil Penulis</p>
                        <div class="flex items-center gap-3">
                            @php
                                $avatar =
                                    optional($sidebar)->author_avatar_url ?:
                                    'https://ui-avatars.com/api/?name=' .
                                        urlencode(optional($sidebar)->author_name ?? ($post->user->name ?? 'Author')) .
                                        '&background=e8edff&color=312e81';
                            @endphp
                            <img src="{{ $avatar }}"
                                alt="{{ optional($sidebar)->author_name ?? ($post->user->name ?? 'Author') }}"
                                class="h-12 w-12 rounded-full bg-indigo-50 object-cover" />
                            <div>
                                <p class="font-semibold text-gray-900">
                                    {{ optional($sidebar)->author_name ?? ($post->user->name ?? 'Author') }}</p>
                                <p class="text-sm text-gray-600">{{ optional($sidebar)->author_role ?? 'Kontributor' }}</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-700 leading-relaxed">
                            {{ optional($sidebar)->author_bio ?? 'Ikuti akun kami untuk update terbaru seputar artikel.' }}
                        </p>
                        <div class="flex flex-wrap gap-2">
                            @if (optional($sidebar)->author_tiktok_url)
                                <a href="{{ optional($sidebar)->author_tiktok_url }}"
                                    class="px-3 py-2 rounded-xl bg-indigo-50 text-indigo-700 text-sm font-semibold">TikTok</a>
                            @endif
                            @if (optional($sidebar)->author_youtube_url)
                                <a href="{{ optional($sidebar)->author_youtube_url }}"
                                    class="px-3 py-2 rounded-xl bg-rose-50 text-rose-600 text-sm font-semibold">YouTube</a>
                            @endif
                            @if (optional($sidebar)->author_newsletter_url)
                                <a href="{{ optional($sidebar)->author_newsletter_url }}"
                                    class="px-3 py-2 rounded-xl bg-gray-50 text-gray-700 text-sm font-semibold">Newsletter</a>
                            @endif
                        </div>
                    </div>

                    {{-- Trending card --}}
                    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-5 space-y-3">
                        <div class="flex items-center justify-between">
                            <p class="text-lg font-semibold text-gray-900">
                                {{ optional($sidebar)->trending_title ?? 'Sedang Tren' }}</p>
                            @if (optional($sidebar)->trending_link_url && optional($sidebar)->trending_link_text)
                                <a href="{{ optional($sidebar)->trending_link_url }}"
                                    class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                                    {{ optional($sidebar)->trending_link_text }}
                                </a>
                            @endif
                        </div>
                        <p class="text-sm text-gray-600">Belum ada artikel tren.</p>
                    </div>

                    {{-- CTA card --}}
                    <div class="rounded-2xl border border-gray-200 bg-white shadow-xl p-6 space-y-3">
                        @if (optional($sidebar)->cta_badge)
                            <p class="text-xs font-semibold uppercase tracking-wide text-indigo-600">
                                {{ optional($sidebar)->cta_badge }}</p>
                        @endif
                        @if (optional($sidebar)->cta_title)
                            <h3 class="text-lg font-bold text-gray-900 leading-6">{{ optional($sidebar)->cta_title }}</h3>
                        @endif
                        @if (optional($sidebar)->cta_subtitle)
                            <p class="text-sm text-gray-600">{{ optional($sidebar)->cta_subtitle }}</p>
                        @endif
                        <div class="pt-2 space-y-3">
                            @if (optional($sidebar)->cta_primary_text && optional($sidebar)->cta_primary_url)
                                <a href="{{ optional($sidebar)->cta_primary_url }}"
                                    class="block w-full rounded-full bg-amber-400 px-4 py-3 text-center text-sm font-semibold text-gray-900 shadow hover:shadow-md transition">
                                    {{ optional($sidebar)->cta_primary_text }}
                                </a>
                            @endif
                            @if (optional($sidebar)->cta_secondary_text && optional($sidebar)->cta_secondary_url)
                                <a href="{{ optional($sidebar)->cta_secondary_url }}"
                                    class="block w-full rounded-full border border-gray-300 px-4 py-3 text-center text-sm font-semibold text-gray-900 hover:bg-gray-50 transition">
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
