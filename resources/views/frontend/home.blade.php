@extends('layouts.frontend')

@section('content')
    <div class="bg-[#FDF6F0] text-gray-900">
        @php
            $placeholder = 'https://placehold.co/900x600?text=No+Image';
        @endphp
        <!-- Editorial Hero Section -->
        <div class="pt-10 pb-16">
            <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
                
                <!-- Main Blog Header (Jasper Style) -->
                <div class="text-center w-full mx-auto mb-16 pt-4 sm:pt-8 px-4">
                    <span class="inline-block px-1 mb-6 text-sm font-bold text-gray-600 bg-white tracking-widest font-mono">
                        Blog Nusa Education
                    </span>
                    <h2 class="text-3xl sm:text-5xl lg:text-6xl font-normal text-faux-semibold text-gray-900 tracking-tight font-heading leading-[1.1] whitespace-nowrap">
                        Wawasan & Strategi Digital Terkini
                    </h2>
                </div>

                @if ($heroPost)
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                        
                        <!-- Left Column: Featured Hero Post (col-span-8) -->
                        <div class="lg:col-span-8">
                            <article class="flex flex-col group bg-white">
                                @if($heroPost->thumbnail_url)
                                <a href="{{ route('posts.show', $heroPost->slug) }}" class="block overflow-hidden">
                                    <img src="{{ $heroPost->thumbnail_url }}" alt="{{ $heroPost->title }}" class="w-full h-[400px] sm:h-[500px] object-cover hover:scale-[1.02] transition duration-700">
                                </a>
                                @endif
                                
                                <div class="p-6 lg:p-8 flex flex-col">
                                    <h1 class="text-3xl sm:text-4xl lg:text-[42px] font-normal text-faux-medium text-[#0a1435] tracking-tight font-heading leading-[1.1] mb-4">
                                        <a href="{{ route('posts.show', $heroPost->slug) }}" class="hover:text-brand-primary transition">
                                            {{ $heroPost->title }}
                                        </a>
                                    </h1>
                                    
                                    <p class="text-[15px] sm:text-base text-gray-800 mb-5 leading-relaxed max-w-3xl">
                                        {{ \Illuminate\Support\Str::limit($heroPost->excerpt ?: strip_tags($heroPost->content ?? ''), 160) }}
                                    </p>
                                    
                                    <div class="inline-flex items-center self-start gap-2 text-xs text-[#705652] bg-[#FCECE9] px-2 py-0.5 font-mono">
                                        <span>{{ optional($heroPost->published_at ?? $heroPost->created_at)->translatedFormat('F j, Y') }}</span>
                                        <span>|</span>
                                        <span>{{ $heroPost->user->name ?? 'Admin' }}</span>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <!-- Right Column: Popular / Sorotan Posts (col-span-4) -->
                        <div class="lg:col-span-4 h-full flex flex-col pt-8 lg:pt-12 relative before:hidden lg:before:block before:absolute before:-left-6 before:top-12 before:bottom-12 before:w-px before:bg-[#e2d5cf]">
                            <h3 class="text-3xl lg:text-[40px] font-normal text-faux-medium text-[#0a1435] font-heading mb-8 self-start whitespace-nowrap bg-white pr-3 py-0 leading-none relative z-10">
                                Sorotan Minggu Ini
                            </h3>
                            
                            <div class="flex flex-col gap-2">
                                @forelse ($topStripPosts as $post)
                                    <article class="flex flex-col group hover:bg-white p-4 -mx-4 transition-colors duration-300">
                                        <div class="inline-flex items-center gap-1.5 text-xs text-[#735A56] bg-white px-1.5 py-0 font-mono mb-2 self-start">
                                            <time datetime="{{ optional($post->published_at ?? $post->created_at)->toDateString() }}">
                                                {{ optional($post->published_at ?? $post->created_at)->translatedFormat('F j') }}
                                            </time>
                                            <span>|</span>
                                            <span>{{ $post->user->name ?? 'Admin' }}</span>
                                        </div>
                                        <h4 class="text-xl sm:text-[22px] font-normal text-faux-medium leading-snug text-[#0a1435] font-heading group-hover:text-brand-primary transition mb-2">
                                            <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                        </h4>
                                        <p class="text-[13px] sm:text-sm text-[#6b5b59] line-clamp-3 leading-relaxed">
                                            {{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content ?? ''), 110) }}
                                        </p>
                                    </article>
                                @empty
                                    <p class="text-sm text-gray-500">Sorotan belum tersedia.</p>
                                @endforelse
                            </div>
                        </div>
                        
                    </div>
                @endif
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 py-16 space-y-16">

            {{-- Latest grid (Full width now, no sidebar) --}}
            <section id="terbaru" class="space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                    <h2 class="text-3xl font-normal text-faux-semibold text-gray-900 font-heading">Artikel Terbaru</h2>
                    <a href="{{ route('posts.index') }}"
                        class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-[#0a1435] border border-[#0a1435] hover:bg-[#0a1435] hover:text-white transition-colors duration-200">
                        Lihat semua
                    </a>
                </div>
                
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @forelse ($featureGridPosts as $post)
                        @php
                            $image = $post->thumbnail_url ?? 'https://placehold.co/900x600?text=No+Image';
                        @endphp
                        <article class="flex flex-col group bg-white">
                            <a href="{{ route('posts.show', $post->slug) }}" class="block overflow-hidden aspect-video w-full">
                                <img src="{{ $image }}" alt="{{ $post->title }}"
                                    class="h-full w-full object-cover group-hover:scale-105 transition duration-700">
                            </a>
                            <div class="flex flex-1 flex-col p-6 sm:p-8">
                                <h3 class="text-[22px] sm:text-2xl font-normal text-faux-medium leading-snug text-[#0a1435] font-heading group-hover:text-brand-primary transition mb-3">
                                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="text-[14px] sm:text-[15px] text-[#6b5b59] line-clamp-3 leading-relaxed mb-8">
                                    {{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content ?? ''), 120) }}
                                </p>
                                <div class="mt-auto inline-flex items-center self-start gap-2 text-xs text-[#705652] bg-[#FCECE9] px-2 py-0.5 font-mono tracking-wide">
                                    <time datetime="{{ optional($post->published_at ?? $post->created_at)->toDateString() }}">
                                        {{ optional($post->published_at ?? $post->created_at)->translatedFormat('F j, Y') }}
                                    </time>
                                    <span>|</span>
                                    <span>{{ $post->user->name ?? 'Admin' }}</span>
                                </div>
                            </div>
                        </article>
                    @empty
                        <p class="text-gray-600 col-span-full">Belum ada artikel terbaru.</p>
                    @endforelse
                </div>
            </section>

            {{-- Gallery preview --}}
            <section class="space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                    <div>
                        <p class="text-[13px] font-bold text-gray-500 uppercase tracking-widest font-mono mb-2">Galeri</p>
                        <h2 class="text-3xl font-normal text-faux-semibold text-gray-900 font-heading mb-1">Momen Terbaru</h2>
                        <p class="text-[15px] text-gray-600">Klik foto untuk melihat ukuran penuh.</p>
                    </div>
                    <a href="{{ route('gallery.index') }}"
                        class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-[#0a1435] border border-[#0a1435] hover:bg-[#0a1435] hover:text-white transition-colors duration-200">Lihat semua</a>
                </div>

                @if ($galleryItems->isEmpty())
                    <p class="text-gray-600">Belum ada foto.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="home-gallery-grid">
                        @foreach ($galleryItems as $item)
                            <button type="button" data-title="{{ $item->title }}"
                                data-description="{{ $item->description }}" data-image="{{ $item->image_url }}"
                                class="group relative h-80 overflow-hidden bg-black">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                    class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105 opacity-90 group-hover:opacity-100"
                                    loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0a1435]/90 via-[#0a1435]/20 to-transparent">
                                </div>
                                <div class="relative flex h-full flex-col justify-end p-6 text-white text-left">
                                    <div class="inline-flex items-center gap-2 text-[11px] uppercase tracking-widest font-mono text-white/80 mb-3">
                                        <span>{{ optional($item->created_at)->translatedFormat('M d, Y') }}</span>
                                    </div>
                                    <h3 class="text-xl sm:text-2xl font-normal text-faux-medium font-heading leading-tight">{{ $item->title }}</h3>
                                    @if ($item->description)
                                        <p class="text-sm text-white/80 mt-2 line-clamp-2">{{ $item->description }}</p>
                                    @endif
                                </div>
                            </button>
                        @endforeach
                    </div>
                @endif
            </section>

            {{-- Newsletter + trending list --}}
            <section class="grid gap-8 lg:grid-cols-3">
                <div class="bg-white p-8 border border-[#e2d5cf] shadow-sm">
                    <h3 class="text-2xl font-normal text-faux-medium text-[#0a1435] font-heading">Berlangganan Buletin</h3>
                    <p class="mt-4 text-[15px] text-[#6b5b59] leading-relaxed">Dapatkan wawasan terbaru dan notifikasi artikel langsung di kotak masuk Anda.</p>

                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap"
                            class="w-full px-4 py-3 bg-[#FDF6F0] border border-transparent focus:border-[#0a1435] focus:bg-white focus:ring-0 transition-colors text-sm @error('name') border-red-500 @enderror">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Alamat Email"
                            class="w-full px-4 py-3 bg-[#FDF6F0] border border-transparent focus:border-[#0a1435] focus:bg-white focus:ring-0 transition-colors text-sm @error('email') border-red-500 @enderror" required>
                        @error('email')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="w-full px-6 py-3.5 text-sm font-bold tracking-widest text-white uppercase bg-[#0a1435] hover:bg-black transition-colors font-mono">
                            Berlangganan
                        </button>
                    </form>
                    <p class="mt-4 text-[13px] text-gray-400">Kami menjaga privasi Anda. Berhenti kapan saja.</p>
                    <div id="newsletter-toast"
                        class="pointer-events-none fixed bottom-6 left-1/2 -translate-x-1/2 transform bg-[#0a1435] text-white px-6 py-4 shadow-2xl opacity-0 translate-y-3 transition duration-300 font-mono text-sm tracking-wide"
                        style="z-index:60;">
                        <span>Terima kasih! Notifikasi artikel terbaru akan dikirim ke email kamu.</span>
                    </div>
                </div>

                <div class="lg:col-span-2 bg-white p-8 border border-[#e2d5cf] shadow-sm flex flex-col">
                    <div class="flex items-center justify-between pb-4 border-b border-gray-200 mb-6">
                        <h3 class="text-2xl font-normal text-faux-medium text-[#0a1435] font-heading">
                            {{ optional($sidebar)->trending_title ?? 'Sedang Tren' }}
                        </h3>
                        @if (optional($sidebar)->trending_link_url && optional($sidebar)->trending_link_text)
                            <a href="{{ optional($sidebar)->trending_link_url }}"
                                class="inline-flex items-center justify-center px-4 py-1.5 text-sm font-semibold text-[#0a1435] border border-[#0a1435] hover:bg-[#0a1435] hover:text-white transition-colors duration-200">{{ optional($sidebar)->trending_link_text }}</a>
                        @else
                            <a href="{{ route('posts.index') }}"
                                class="inline-flex items-center justify-center px-4 py-1.5 text-sm font-semibold text-[#0a1435] border border-[#0a1435] hover:bg-[#0a1435] hover:text-white transition-colors duration-200">Lihat semua</a>
                        @endif
                    </div>
                    
                    <div class="grid gap-6 md:grid-cols-2 flex-1">
                        @forelse ($trendingPosts as $post)
                            @php
                                $image = $post->thumbnail_url ?? $placeholder;
                            @endphp
                            <article class="flex gap-5 group items-start pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                                <a href="{{ route('posts.show', $post->slug) }}" class="block shrink-0 overflow-hidden w-28 aspect-[4/3]">
                                    <img src="{{ $image }}" alt="{{ $post->title }}"
                                        class="h-full w-full object-cover group-hover:scale-105 transition duration-700">
                                </a>
                                <div class="flex flex-1 flex-col">
                                    <div class="inline-flex items-center gap-1.5 text-[11px] text-[#735A56] font-mono mb-2 uppercase tracking-widest">
                                        <span>{{ $post->category->name ?? 'Umum' }}</span>
                                    </div>
                                    <h4 class="text-[17px] font-normal text-faux-medium leading-snug text-[#0a1435] font-heading group-hover:text-brand-primary transition">
                                        <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                    </h4>
                                    <p class="mt-2 text-[13px] text-[#6b5b59] line-clamp-2 leading-relaxed">
                                        {{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content ?? ''), 70) }}
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
