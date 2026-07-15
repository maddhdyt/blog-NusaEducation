@extends('layouts.frontend')

@section('content')
    <div class="bg-[#f7f7f9] py-10 sm:py-14">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-8">
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-blue-600 uppercase tracking-[0.2em]">Kategori</p>
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">{{ $category->name }}</h1>
                    @if ($category->description)
                        <p class="text-gray-600 text-lg leading-relaxed max-w-3xl">{{ $category->description }}</p>
                    @endif
                </div>

                <div class="flex flex-wrap gap-3">
                    @foreach ($allCategories as $item)
                        <a href="{{ route('categories.show', $item->slug) }}"
                            class="px-4 py-2 rounded-full text-sm font-semibold transition border
                            {{ $category->id === $item->id ? 'bg-blue-600 border-blue-600 text-white shadow-sm' : 'bg-white border-gray-200 text-gray-700 hover:border-blue-400 hover:text-blue-700' }}">
                            {{ $item->name }}
                        </a>
                    @endforeach
                </div>

                <div class="bg-white border border-gray-100 rounded-3xl divide-y divide-gray-100 shadow-sm">
                    @forelse ($posts as $post)
                        <article class="flex flex-col sm:flex-row gap-6 p-5 sm:p-6 lg:p-7">
                            <div
                                class="w-full sm:w-44 h-44 flex-shrink-0 overflow-hidden rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200">
                                @if ($post->thumbnail_url)
                                    <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center text-3xl font-bold text-gray-500">
                                        {{ Str::upper(Str::substr($post->title, 0, 1)) }}
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1 space-y-3">
                                <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500">
                                    <span>{{ optional($post->published_at)->format('M d, Y') }}</span>
                                    <span
                                        class="px-2 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">{{ $category->name }}</span>
                                </div>

                                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 leading-snug">
                                    <a href="{{ route('posts.show', $post->slug) }}"
                                        class="hover:text-blue-700">{{ $post->title }}</a>
                                </h2>

                                <p class="text-gray-600 leading-relaxed max-w-3xl">
                                    {{ Str::limit($post->excerpt ?: strip_tags($post->content), 160) }}
                                </p>

                                <div class="flex items-center gap-3 text-sm text-gray-600">
                                    <div
                                        class="h-10 w-10 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center text-gray-500 font-semibold">
                                        {{ Str::upper(Str::substr($post->user->name ?? 'A', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $post->user->name ?? 'Unknown' }}</p>
                                        <p class="text-gray-500">Post by {{ $post->user->name ?? 'Unknown' }}</p>
                                    </div>
                                </div>

                                <div>
                                    <a href="{{ route('posts.show', $post->slug) }}"
                                        class="inline-flex items-center gap-1 font-semibold text-blue-700 hover:text-blue-800">
                                        Read More
                                        <span aria-hidden="true">→</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="p-10 text-center text-gray-500 text-lg">Belum ada postingan dalam kategori ini.</div>
                    @endforelse
                </div>

                @if ($posts->hasPages())
                    <div class="flex justify-center">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
