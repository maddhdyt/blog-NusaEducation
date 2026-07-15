@extends('layouts.frontend')

@section('content')
    <div class="bg-gray-50 text-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-14">
            @php
                $placeholder = 'https://placehold.co/900x600?text=No+Image';
            @endphp

            {{-- Hero + highlight strip --}}
            <section class="grid gap-6 lg:grid-cols-3">
                @if ($heroPost)
                    @php
                        $heroImage = $heroPost->thumbnail_url ?? $placeholder;
                    @endphp
                    <article
                        class="relative overflow-hidden rounded-2xl bg-gray-900 text-white min-h-[420px] lg:col-span-2 shadow-lg">
                        <img src="{{ $heroImage }}" alt="{{ $heroPost->title }}"
                            class="absolute inset-0 h-full w-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/65 to-gray-900/20"></div>
                        <div class="relative flex h-full flex-col justify-end p-8 sm:p-10">
                            <div class="flex items-center gap-3 text-xs text-gray-200">
                                <span
                                    class="inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1 font-semibold text-blue-100">
                                    {{ $heroPost->category->name ?? 'Umum' }}
                                </span>
                                <span class="rounded-full bg-white/10 px-3 py-1">
                                    {{ optional($heroPost->published_at ?? $heroPost->created_at)->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            <h1 class="mt-4 text-3xl sm:text-4xl font-semibold leading-tight">{{ $heroPost->title }}</h1>
                            <p class="mt-4 text-base text-gray-200 line-clamp-3">
                                {{ \Illuminate\Support\Str::limit($heroPost->excerpt ?: strip_tags($heroPost->content ?? ''), 180) }}
                            </p>
                            <div class="mt-6 flex items-center gap-4 text-sm text-gray-200">
                                <span
                                    class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-white/15 ring-1 ring-white/10">
                                    {{ \Illuminate\Support\Str::of($heroPost->user->name ?? 'Author')->substr(0, 1)->upper() }}
                                </span>
                                <div>
                                    <p class="font-semibold">{{ $heroPost->user->name ?? 'Author' }}</p>
                                    <p class="text-gray-300">{{ $heroPost->user->role ?? 'Kontributor' }}</p>
                                </div>
                                <a href="{{ route('posts.show', $heroPost->slug) }}"
                                    class="ml-auto inline-flex items-center rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 transition">
                                    Baca selengkapnya
                                </a>
                            </div>
                        </div>
                    </article>
                @else
                    <div class="lg:col-span-3 rounded-2xl bg-white border border-gray-200 shadow-sm p-8 text-center">
                        <p class="text-gray-600">Belum ada artikel yang dipublikasikan.</p>
                    </div>
                @endif

                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Sorotan</h3>
                        <span class="text-sm text-gray-500">{{ $topStripPosts->count() }} cerita</span>
                    </div>
                    @forelse ($topStripPosts as $post)
                        @php
                            $image = $post->thumbnail_url ?? $placeholder;
                        @endphp
                        <article class="flex gap-3 rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                            <img src="{{ $image }}" alt="{{ $post->title }}" class="h-28 w-28 object-cover">
                            <div class="flex flex-1 flex-col justify-between p-4">
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <span class="font-semibold text-blue-600">{{ $post->category->name ?? 'Umum' }}</span>
                                    <span>&middot;</span>
                                    <time
                                        datetime="{{ optional($post->published_at ?? $post->created_at)->toDateString() }}">
                                        {{ optional($post->published_at ?? $post->created_at)->translatedFormat('d M Y') }}
                                    </time>
                                </div>
                                <h4 class="text-sm font-semibold leading-5 text-gray-900 line-clamp-2">
                                    <a href="{{ route('posts.show', $post->slug) }}"
                                        class="hover:text-blue-600">{{ $post->title }}</a>
                                </h4>
                                <p class="text-xs text-gray-600 line-clamp-2">
                                    {{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content ?? ''), 90) }}
                                </p>
                            </div>
                        </article>
                    @empty
                        <p class="text-sm text-gray-500">Sorotan belum tersedia.</p>
                    @endforelse
                </div>
            </section>

            {{-- Latest grid + sidebar --}}
            <section class="grid gap-8 lg:grid-cols-4">
                <div class="lg:col-span-3 space-y-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-semibold text-gray-900">Terbaru</h2>
                        <a href="{{ route('posts.index') }}"
                            class="text-sm font-semibold text-blue-600 hover:text-blue-700">Lihat semua</a>
                    </div>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse ($featureGridPosts as $post)
                            @php
                                $image = $post->thumbnail_url ?? $placeholder;
                            @endphp
                            <article
                                class="group rounded-2xl bg-white shadow-sm border border-gray-200 overflow-hidden flex flex-col">
                                <div class="relative">
                                    <img src="{{ $image }}" alt="{{ $post->title }}"
                                        class="h-44 w-full object-cover">
                                    <span
                                        class="absolute left-3 top-3 inline-flex rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-blue-700 ring-1 ring-blue-100">
                                        {{ $post->category->name ?? 'Umum' }}
                                    </span>
                                </div>
                                <div class="p-4 flex-1 flex flex-col">
                                    <div class="text-xs text-gray-500 flex items-center gap-2">
                                        <time
                                            datetime="{{ optional($post->published_at ?? $post->created_at)->toDateString() }}">
                                            {{ optional($post->published_at ?? $post->created_at)->translatedFormat('d M Y') }}
                                        </time>
                                    </div>
                                    <h3
                                        class="mt-2 text-lg font-semibold leading-6 text-gray-900 group-hover:text-blue-600 line-clamp-2">
                                        <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                    </h3>
                                    <p class="mt-2 text-sm text-gray-600 line-clamp-3">
                                        {{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content ?? ''), 120) }}
                                    </p>
                                    <div class="mt-4 flex items-center gap-3 text-sm text-gray-600">
                                        <span
                                            class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-700 font-semibold">
                                            {{ \Illuminate\Support\Str::of($post->user->name ?? 'A')->substr(0, 1)->upper() }}
                                        </span>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $post->user->name ?? 'Author' }}</p>
                                            <p class="text-gray-500">{{ $post->user->role ?? 'Kontributor' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <p class="text-gray-600">Belum ada artikel terbaru.</p>
                        @endforelse
                    </div>
                </div>

                <aside class="space-y-6">
                    @php
                        $profileUser = optional($heroPost?->user);
                        $sidebarAuthorName = optional($sidebar)->author_name ?? ($profileUser->name ?? 'Tim Redaksi');
                        $sidebarAuthorRole = optional($sidebar)->author_role ?? ($profileUser->role ?? 'Kontributor');
                        $sidebarBio =
                            optional($sidebar)->author_bio ?? 'Ikuti akun kami untuk update terbaru seputar artikel.';
                        $avatar =
                            optional($sidebar)->author_avatar_url ?:
                            'https://ui-avatars.com/api/?name=' .
                                urlencode($sidebarAuthorName) .
                                '&background=e8edff&color=312e81';
                    @endphp
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">Profil Penulis</p>
                        <div class="mt-4 flex items-center gap-4">
                            <img src="{{ $avatar }}" alt="{{ $sidebarAuthorName }}"
                                class="h-14 w-14 rounded-full object-cover bg-blue-50">
                            <div>
                                <p class="text-lg font-semibold text-gray-900">{{ $sidebarAuthorName }}</p>
                                <p class="text-sm text-gray-500">{{ $sidebarAuthorRole }}</p>
                            </div>
                        </div>
                        <p class="mt-3 text-sm text-gray-600">{{ $sidebarBio }}</p>
                        <div class="mt-4 grid grid-cols-3 gap-3 text-center">
                            @if (optional($sidebar)->author_tiktok_url)
                                <a href="{{ optional($sidebar)->author_tiktok_url }}"
                                    class="rounded-xl border border-blue-100 bg-blue-50 px-3 py-2 text-sm font-semibold text-blue-700 hover:border-blue-200">TikTok</a>
                            @endif
                            @if (optional($sidebar)->author_youtube_url)
                                <a href="{{ optional($sidebar)->author_youtube_url }}"
                                    class="rounded-xl border border-red-100 bg-red-50 px-3 py-2 text-sm font-semibold text-red-600 hover:border-red-200">YouTube</a>
                            @endif
                            @if (optional($sidebar)->author_newsletter_url)
                                <a href="{{ optional($sidebar)->author_newsletter_url }}"
                                    class="rounded-xl border border-gray-200 px-3 py-2 text-sm font-semibold text-gray-700 hover:border-gray-300">Newsletter</a>
                            @endif
                        </div>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-base font-semibold text-gray-900">Kategori Populer</h3>
                        <div class="mt-4 space-y-3">
                            @forelse ($categories as $category)
                                <a href="{{ route('categories.show', $category->slug) }}"
                                    class="flex items-center justify-between rounded-xl border border-gray-100 px-4 py-3 hover:border-blue-200 hover:bg-blue-50 transition">
                                    <span class="font-medium text-gray-900">{{ $category->name }}</span>
                                    <span class="text-sm text-gray-500">{{ $category->published_posts_count }}
                                        artikel</span>
                                </a>
                            @empty
                                <p class="text-sm text-gray-600">Belum ada kategori.</p>
                            @endforelse
                        </div>
                    </div>
                </aside>
            </section>

            {{-- Spotlight stories --}}
            <section class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold text-gray-900">Sorotan Minggu Ini</h2>
                    <span class="text-sm text-gray-500">Pilihan editor</span>
                </div>

                <div class="grid gap-6 lg:grid-cols-3">
                    @forelse ($spotlightPosts as $post)
                        @php
                            $image = $post->thumbnail_url ?? $placeholder;
                        @endphp
                        <article class="flex gap-4 rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                            <img src="{{ $image }}" alt="{{ $post->title }}"
                                class="h-32 w-32 rounded-xl object-cover">
                            <div class="flex flex-1 flex-col justify-between">
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <span class="font-semibold text-blue-600">{{ $post->category->name ?? 'Umum' }}</span>
                                    <span>&middot;</span>
                                    <time
                                        datetime="{{ optional($post->published_at ?? $post->created_at)->toDateString() }}">
                                        {{ optional($post->published_at ?? $post->created_at)->translatedFormat('d M Y') }}
                                    </time>
                                </div>
                                <h3 class="text-lg font-semibold leading-6 text-gray-900 line-clamp-2">
                                    <a href="{{ route('posts.show', $post->slug) }}"
                                        class="hover:text-blue-600">{{ $post->title }}</a>
                                </h3>
                                <p class="text-sm text-gray-600 line-clamp-3">
                                    {{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content ?? ''), 110) }}
                                </p>
                            </div>
                        </article>
                    @empty
                        <p class="text-gray-600">Belum ada sorotan.</p>
                    @endforelse
                </div>
            </section>

            {{-- Gallery preview --}}
            <section class="space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">Galeri</p>
                        <h2 class="text-2xl font-semibold text-gray-900">Momen Terbaru</h2>
                        <p class="text-sm text-gray-600">Klik foto untuk melihat ukuran penuh.</p>
                    </div>
                    <a href="{{ route('gallery.index') }}"
                        class="text-sm font-semibold text-blue-600 hover:text-blue-700">Lihat semua</a>
                </div>

                @if ($galleryItems->isEmpty())
                    <p class="text-gray-600">Belum ada foto.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="home-gallery-grid">
                        @foreach ($galleryItems as $item)
                            <button type="button" data-title="{{ $item->title }}"
                                data-description="{{ $item->description }}" data-image="{{ $item->image_url }}"
                                class="group relative h-80 overflow-hidden rounded-3xl bg-black shadow-lg ring-1 ring-black/10">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                    class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                    loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-b from-black/15 via-black/35 to-black/85">
                                </div>
                                <div class="relative flex h-full flex-col justify-end p-5 space-y-2 text-white">
                                    <div class="flex items-center gap-3 text-xs text-white/80">
                                        <span>{{ optional($item->created_at)->translatedFormat('M d, Y') }}</span>
                                        <span class="h-1 w-1 rounded-full bg-white/70"></span>
                                        <span>Galeri</span>
                                    </div>
                                    <h3 class="text-lg font-semibold leading-tight drop-shadow">{{ $item->title }}</h3>
                                    @if ($item->description)
                                        <p class="text-sm text-white/90 line-clamp-2">{{ $item->description }}</p>
                                    @endif
                                </div>
                            </button>
                        @endforeach
                    </div>
                @endif
            </section>

            {{-- Newsletter + trending list --}}
            <section class="grid gap-6 lg:grid-cols-3">
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-xl font-semibold text-gray-900">Berlangganan buletin</h3>
                    <p class="mt-2 text-sm text-gray-600">Ingin dapat notifikasi artikel terbaru? Tulis nama dan email
                        kamu lalu tekan Subscribe.</p>

                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="mt-4 space-y-3">
                        @csrf
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama"
                            class="form-input @error('name') border-red-500 @enderror">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                            class="form-input @error('email') border-red-500 @enderror" required>
                        @error('email')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="btn-primary w-full justify-center">Subscribe</button>
                    </form>
                    <p class="mt-3 text-xs text-gray-500">Kami tidak mengirim spam. Bisa berhenti langganan kapan saja.</p>
                    <div id="newsletter-toast"
                        class="pointer-events-none fixed bottom-6 left-1/2 -translate-x-1/2 transform rounded-xl bg-gray-900 text-white px-4 py-3 shadow-2xl ring-1 ring-black/10 opacity-0 translate-y-3 transition duration-300"
                        style="z-index:60;">
                        <span class="text-sm font-semibold">Terima kasih! Notifikasi artikel terbaru akan dikirim ke email
                            kamu.</span>
                    </div>
                </div>

                <div class="lg:col-span-2 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ optional($sidebar)->trending_title ?? 'Sedang Tren' }}</h3>
                        @if (optional($sidebar)->trending_link_url && optional($sidebar)->trending_link_text)
                            <a href="{{ optional($sidebar)->trending_link_url }}"
                                class="text-sm font-semibold text-blue-600 hover:text-blue-700">{{ optional($sidebar)->trending_link_text }}</a>
                        @else
                            <a href="{{ route('posts.index') }}"
                                class="text-sm font-semibold text-blue-600 hover:text-blue-700">Lihat semua</a>
                        @endif
                    </div>
                    <div class="mt-4 grid gap-4 md:grid-cols-2">
                        @forelse ($trendingPosts as $post)
                            @php
                                $image = $post->thumbnail_url ?? $placeholder;
                            @endphp
                            <article
                                class="flex gap-4 rounded-xl border border-gray-100 p-4 hover:border-blue-200 hover:bg-blue-50/60 transition">
                                <img src="{{ $image }}" alt="{{ $post->title }}"
                                    class="h-20 w-24 rounded-lg object-cover">
                                <div class="flex flex-1 flex-col">
                                    <span
                                        class="text-xs font-semibold text-blue-600">{{ $post->category->name ?? 'Umum' }}</span>
                                    <h4 class="text-base font-semibold text-gray-900 leading-5 line-clamp-2 mt-1">
                                        <a href="{{ route('posts.show', $post->slug) }}"
                                            class="hover:text-blue-600">{{ $post->title }}</a>
                                    </h4>
                                    <p class="mt-2 text-xs text-gray-600 line-clamp-2">
                                        {{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content ?? ''), 80) }}
                                    </p>
                                </div>
                            </article>
                        @empty
                            <p class="text-gray-600">Belum ada artikel tren.</p>
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- Shared gallery modal --}}
    <div id="shared-gallery-modal"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full overflow-hidden">
            <div class="flex items-center justify-between px-4 sm:px-6 py-3 border-b border-gray-200">
                <div class="space-y-1">
                    <h3 id="shared-gallery-modal-title" class="text-lg font-semibold text-gray-900"></h3>
                    <p id="shared-gallery-modal-desc" class="text-sm text-gray-600"></p>
                </div>
                <button type="button" id="shared-gallery-modal-close"
                    class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <div class="bg-black">
                <img id="shared-gallery-modal-image" src="" alt=""
                    class="w-full h-[70vh] object-contain bg-black">
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('shared-gallery-modal');
            const titleEl = document.getElementById('shared-gallery-modal-title');
            const descEl = document.getElementById('shared-gallery-modal-desc');
            const imgEl = document.getElementById('shared-gallery-modal-image');
            const closeBtn = document.getElementById('shared-gallery-modal-close');

            const openModal = (title, desc, src) => {
                titleEl.textContent = title || '';
                descEl.textContent = desc || '';
                imgEl.src = src;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            };

            const closeModal = () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                imgEl.src = '';
            };

            const bindButtons = (selector) => {
                document.querySelectorAll(selector).forEach(btn => {
                    btn.addEventListener('click', () => {
                        openModal(btn.dataset.title, btn.dataset.description, btn.dataset
                            .image);
                    });
                });
            };

            bindButtons('#home-gallery-grid button');

            closeBtn?.addEventListener('click', closeModal);
            modal?.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeModal();
            });

            const toast = document.getElementById('newsletter-toast');
            if (toast && {{ session('subscribe_success') ? 'true' : 'false' }}) {
                toast.classList.remove('opacity-0', 'translate-y-3');
                toast.classList.add('opacity-100', 'translate-y-0');
                setTimeout(() => {
                    toast.classList.add('opacity-0', 'translate-y-3');
                }, 2600);
            }
        });
    </script>
@endpush
