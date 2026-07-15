@extends('layouts.frontend')

@section('content')
    @php
        $featured = $posts->take(1);
        $secondary = $posts->skip(1)->take(3);
        $rest = $posts->skip(4);
    @endphp

    <div class="bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14 space-y-12">
            <header class="space-y-4">
                @php
                    $searchQuery = $searchQuery ?? '';
                    $hasQuery = $searchQuery !== '';
                @endphp

                @if ($hasQuery)
                    <p class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">Hasil pencarian</p>
                    <div class="flex items-center gap-3 flex-wrap">
                        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">"{{ $searchQuery }}"</h1>
                        <span
                            class="text-sm font-semibold text-gray-600 bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full">
                            {{ $posts->total() }} artikel
                        </span>
                    </div>
                    <form action="{{ route('posts.search') }}" method="GET" class="mt-2">
                        <div class="flex items-center gap-3">
                            <input type="text" name="q" value="{{ $searchQuery }}" placeholder="Cari artikel..."
                                class="w-full sm:w-96 rounded-lg border-gray-200 shadow-sm focus:border-indigo-400 focus:ring-indigo-400">
                            <button type="submit"
                                class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-white font-semibold hover:bg-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 5 5a7.5 7.5 0 0 0 11.65 11.65Z" />
                                </svg>
                                Cari
                            </button>
                        </div>
                    </form>
                @else
                    <p class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">Blog & Insights</p>
                    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900">Artikel terbaru</h1>
                    <p class="text-lg text-gray-600 max-w-3xl">Kumpulan update, tips, dan insight seputar topik terbaru.
                        Semua
                        konten ditarik dinamis dari database.</p>
                @endif
            </header>

            @if ($featured->isNotEmpty())
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    @php($main = $featured->first())
                    <article
                        class="lg:col-span-2 relative overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-100">
                        <div class="aspect-[16/9] overflow-hidden">
                            @if ($main->thumbnail)
                                <img src="{{ $main->thumbnail_url }}" alt="{{ $main->title }}"
                                    class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full bg-gradient-to-br from-indigo-500 to-purple-500"></div>
                            @endif
                        </div>
                        <div class="p-6 sm:p-8 space-y-4">
                            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500">
                                @if (!empty($main->category))
                                    <a href="{{ route('categories.show', $main->category->slug) }}"
                                        class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 font-semibold text-indigo-700 hover:bg-indigo-100">
                                        {{ $main->category->name }}
                                    </a>
                                @endif
                                <span>{{ optional($main->published_at ?? $main->created_at)->translatedFormat('d M Y') }}</span>
                                <span class="text-gray-300">•</span>
                                <span>Oleh {{ $main->user->name ?? 'Admin' }}</span>
                            </div>
                            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-tight">
                                <a href="{{ route('posts.show', $main->slug) }}" class="hover:text-indigo-700">
                                    {{ $main->title }}
                                </a>
                            </h2>
                            @if ($main->excerpt)
                                <p class="text-lg text-gray-600">{{ Str::limit($main->excerpt, 170) }}</p>
                            @endif
                            <div class="flex items-center gap-3">
                                <img src="{{ $main->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($main->user->name ?? 'Author') . '&background=4338ca&color=fff' }}"
                                    alt="{{ $main->user->name ?? 'Author' }}"
                                    class="h-10 w-10 rounded-full bg-indigo-50" />
                                <div class="text-sm text-gray-600">
                                    <p class="font-semibold text-gray-900">{{ $main->user->name ?? 'Author' }}</p>
                                    <p>{{ $main->user->role ?? 'Contributor' }}</p>
                                </div>
                            </div>
                        </div>
                    </article>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4 lg:gap-5">
                        @foreach ($secondary as $side)
                            <article class="flex gap-4 rounded-2xl bg-white shadow ring-1 ring-gray-100 overflow-hidden">
                                <div class="w-32 shrink-0 overflow-hidden">
                                    @if ($side->thumbnail)
                                        <img src="{{ $side->thumbnail_url }}" alt="{{ $side->title }}"
                                            class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full bg-gradient-to-br from-indigo-400 to-purple-500"></div>
                                    @endif
                                </div>
                                <div class="p-4 space-y-2 flex-1">
                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <span>{{ optional($side->published_at ?? $side->created_at)->translatedFormat('d M Y') }}</span>
                                        <span class="text-gray-300">•</span>
                                        <span>{{ $side->user->name ?? 'Admin' }}</span>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 leading-snug">
                                        <a href="{{ route('posts.show', $side->slug) }}" class="hover:text-indigo-700">
                                            {{ Str::limit($side->title, 80) }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-gray-600 line-clamp-2">
                                        {{ Str::limit($side->excerpt ?: strip_tags($side->content ?? ''), 100) }}
                                    </p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            <section class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <div class="lg:col-span-3 space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($rest as $post)
                            <article
                                class="relative overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 hover:shadow-lg transition">
                                <div class="aspect-[4/3] overflow-hidden">
                                    @if ($post->thumbnail)
                                        <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}"
                                            class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full bg-gradient-to-br from-indigo-500 to-purple-500"></div>
                                    @endif
                                </div>
                                <div class="p-4 space-y-3">
                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        @if (!empty($post->category))
                                            <a href="{{ route('categories.show', $post->category->slug) }}"
                                                class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-1 font-semibold text-indigo-700 hover:bg-indigo-100">
                                                {{ $post->category->name }}
                                            </a>
                                        @endif
                                        <span>{{ optional($post->published_at ?? $post->created_at)->translatedFormat('d M Y') }}</span>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 leading-snug">
                                        <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-indigo-700">
                                            {{ Str::limit($post->title, 90) }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-gray-600 line-clamp-3">
                                        {{ Str::limit($post->excerpt ?: strip_tags($post->content ?? ''), 130) }}
                                    </p>
                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <span>{{ $post->user->name ?? 'Admin' }}</span>
                                        <span class="text-gray-300">•</span>
                                        <span>Read more →</span>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div
                                class="col-span-full text-center py-12 bg-white rounded-2xl shadow-sm ring-1 ring-gray-100">
                                @if ($hasQuery)
                                    <p class="text-gray-900 text-lg font-semibold">Tidak ada hasil untuk
                                        "{{ $searchQuery }}"</p>
                                    <p class="text-gray-500 mt-2">Coba kata kunci lain atau telusuri semua artikel.</p>
                                    <a href="{{ route('posts.index') }}"
                                        class="inline-flex items-center gap-2 mt-4 text-indigo-600 font-semibold">
                                        Lihat semua artikel
                                        <span aria-hidden="true">→</span>
                                    </a>
                                @else
                                    <p class="text-gray-500 text-lg">Belum ada artikel.</p>
                                @endif
                            </div>
                        @endforelse
                    </div>

                    <div class="pt-2">
                        {{ $posts->links() }}
                    </div>
                </div>

                <aside class="space-y-6">
                    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 p-5">
                        <p class="text-xs font-semibold uppercase tracking-wide text-indigo-600">Newsletter</p>
                        <h3 class="text-lg font-bold text-gray-900 mt-2">Dapatkan update terbaru</h3>
                        <p class="text-sm text-gray-600 mt-1">Langganan untuk menerima highlight artikel.</p>
                        <form class="mt-4 space-y-3">
                            <input type="email" name="email" placeholder="Email kamu"
                                class="w-full rounded-lg border-gray-200 shadow-sm focus:border-indigo-400 focus:ring-indigo-400">
                            <button type="button"
                                class="w-full rounded-lg bg-indigo-600 px-4 py-2 text-white font-semibold hover:bg-indigo-500">
                                Langganan
                            </button>
                        </form>
                    </div>

                    @if ($secondary->isNotEmpty())
                        <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 p-5 space-y-4">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-gray-900">Sorotan</p>
                                <span class="text-xs text-indigo-600 font-semibold">Pilihan</span>
                            </div>
                            <div class="space-y-4">
                                @foreach ($secondary as $hot)
                                    <a href="{{ route('posts.show', $hot->slug) }}" class="flex gap-3 group">
                                        <div class="h-16 w-20 overflow-hidden rounded-lg bg-indigo-50">
                                            @if ($hot->thumbnail)
                                                <img src="{{ $hot->thumbnail_url }}" alt="{{ $hot->title }}"
                                                    class="h-full w-full object-cover">
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs text-gray-500">
                                                {{ optional($hot->published_at ?? $hot->created_at)->translatedFormat('d M Y') }}
                                            </p>
                                            <p class="text-sm font-semibold text-gray-900 group-hover:text-indigo-700">
                                                {{ Str::limit($hot->title, 80) }}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </aside>
            </section>
        </div>
    </div>
@endsection
