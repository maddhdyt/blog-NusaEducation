<nav class="bg-white/95 backdrop-blur shadow-sm border-b border-[#e2d5cf] sticky top-0 z-50">
    <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ $siteLogo }}" alt="Nusa Education" class="h-10 md:h-12 w-auto">
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                @foreach ($menus as $menu)
                    @if ($menu->children->isEmpty())
                        <a href="{{ $menu->getUrl() }}" class="text-[15px] font-medium text-[#0a1435] font-sans hover:text-brand-primary transition">
                            {{ $menu->title }}
                        </a>
                    @else
                        <div class="relative group">
                            <button type="button"
                                class="flex items-center gap-1.5 text-[15px] font-medium text-[#0a1435] font-sans hover:text-brand-primary transition py-2">
                                {{ $menu->title }}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="h-4 w-4 text-gray-400 group-hover:text-brand-primary transition">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.25a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div
                                class="absolute left-1/2 top-full mt-2 w-[480px] -translate-x-1/2 bg-white border border-[#e2d5cf] shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible group-focus-within:opacity-100 group-focus-within:visible transition-all z-50">
                                <div class="p-6 grid gap-4">
                                    @foreach ($menu->children as $child)
                                        <a href="{{ $child->getUrl() }}"
                                            class="flex items-start gap-4 p-3 hover:bg-[#FDF6F0] transition group/child">
                                        @php
                                            $iconClass = 'h-5 w-5';
                                            $bgColor = 'bg-[#0a1435]';
                                            
                                            if ($child->url_type === 'category') {
                                                $icon = '<svg class="'.$iconClass.'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" /></svg>';
                                            } elseif ($child->url_type === 'page') {
                                                $icon = '<svg class="'.$iconClass.'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.813-6.837c.31-.555.05-1.282-.575-1.477a1.35 1.35 0 00-1.632.7c-1.326 2.65-2.652 5.3-4.628 7.373z" /></svg>';
                                            } elseif ($child->url_type === 'post') {
                                                $icon = '<svg class="'.$iconClass.'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 9l3 3-3 3m5 0h3M4 17h16a1 1 0 001-1V8a1 1 0 00-1-1H4a1 1 0 00-1 1v8a1 1 0 001 1z" /></svg>';
                                            } else {
                                                $icon = '<svg class="'.$iconClass.'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>';
                                            }
                                        @endphp
                                            <span
                                                class="inline-flex h-10 w-10 shrink-0 items-center justify-center {{ $bgColor }} text-white group-hover/child:scale-110 transition-transform">
                                                {!! $icon !!}
                                            </span>
                                            <span class="flex flex-col gap-1">
                                                <span
                                                    class="text-[15px] font-medium text-[#0a1435] font-sans group-hover/child:text-brand-primary transition">{{ $child->title }}</span>
                                                <span
                                                    class="text-[13px] text-[#6b5b59] leading-relaxed">{{ $child->description ?? 'Learn more about ' . $child->title }}</span>
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Desktop Search & Actions -->
            <div class="hidden md:flex items-center space-x-4">
                <div class="relative">
                    <button type="button" id="navSearchToggle"
                        class="p-2 text-[#0a1435] hover:text-brand-primary focus:outline-none transition"
                        aria-label="Cari artikel">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 5 5a7.5 7.5 0 0 0 11.65 11.65Z" />
                        </svg>
                    </button>

                    <div id="navSearchPanel"
                        class="hidden absolute right-0 mt-4 w-96 bg-white border border-[#e2d5cf] p-6 shadow-xl z-50">
                        <form action="{{ route('posts.search') }}" method="GET" class="space-y-4">
                            <div class="flex items-center gap-2">
                                <input type="text" name="q" placeholder="Cari artikel..." autocomplete="off"
                                    class="flex-1 min-w-0 px-4 py-2.5 bg-[#FDF6F0] border border-transparent focus:border-[#0a1435] focus:bg-white focus:ring-0 transition-colors text-sm">
                                <button type="submit" class="px-5 py-2.5 text-sm font-bold tracking-widest text-white uppercase bg-[#0a1435] hover:bg-black transition-colors font-mono">
                                    Cari
                                </button>
                            </div>
                            <p class="text-xs text-[#735A56] font-mono tracking-wide uppercase">Cari artikel terbaru dan populer.</p>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center gap-4">
                <button type="button" id="mobileSearchBtn" class="text-[#0a1435] hover:text-brand-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 5 5a7.5 7.5 0 0 0 11.65 11.65Z" />
                    </svg>
                </button>
                <button type="button" id="mobileMenuBtn" class="text-[#0a1435] hover:text-brand-primary transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Search Overlay -->
<div id="mobileSearchOverlay" class="fixed inset-0 bg-white z-[60] hidden flex-col">
    <div class="flex items-center justify-between p-4 border-b border-[#e2d5cf]">
        <span class="text-sm font-bold font-mono uppercase tracking-widest text-[#0a1435]">Pencarian</span>
        <button type="button" id="closeMobileSearchBtn" class="p-2 text-[#0a1435]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <div class="p-6">
        <form action="{{ route('posts.search') }}" method="GET" class="space-y-4">
            <input type="text" name="q" placeholder="Cari artikel..." autocomplete="off"
                class="w-full px-4 py-3 bg-[#FDF6F0] border border-transparent focus:border-[#0a1435] focus:bg-white focus:ring-0 transition-colors text-sm">
            <button type="submit" class="w-full px-5 py-3 text-sm font-bold tracking-widest text-white uppercase bg-[#0a1435] hover:bg-black transition-colors font-mono">
                Cari Artikel
            </button>
        </form>
    </div>
</div>

<!-- Mobile Menu Overlay -->
<div id="mobileMenuOverlay" class="fixed inset-0 bg-black/50 z-[60] hidden backdrop-blur-sm">
    <div id="mobileMenuDrawer" class="absolute right-0 top-0 bottom-0 w-4/5 max-w-sm bg-white shadow-2xl flex flex-col translate-x-full transition-transform duration-300">
        <div class="flex items-center justify-between p-6 border-b border-[#e2d5cf]">
            <span class="text-sm font-bold font-mono uppercase tracking-widest text-[#0a1435]">Menu</span>
            <button type="button" id="closeMobileMenuBtn" class="p-2 -mr-2 text-[#0a1435]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6 overflow-y-auto flex-1">
            <ul class="space-y-6">
                @foreach ($menus as $menu)
                    @if ($menu->children->isEmpty())
                        <li>
                            <a href="{{ $menu->getUrl() }}" class="block text-xl font-medium text-[#0a1435] font-sans">
                                {{ $menu->title }}
                            </a>
                        </li>
                    @else
                        <li class="space-y-4">
                            <span class="block text-xl font-medium text-[#0a1435] font-sans border-b border-[#e2d5cf] pb-2">
                                {{ $menu->title }}
                            </span>
                            <ul class="space-y-4 pl-4 border-l border-[#e2d5cf]">
                                @foreach ($menu->children as $child)
                                    <li>
                                        <a href="{{ $child->getUrl() }}" class="block text-[15px] text-[#6b5b59]">
                                            {{ $child->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Desktop Search
        const toggle = document.getElementById('navSearchToggle');
        const panel = document.getElementById('navSearchPanel');

        if (toggle && panel) {
            const closePanel = () => panel.classList.add('hidden');
            toggle.addEventListener('click', (event) => {
                event.stopPropagation();
                panel.classList.toggle('hidden');
            });
            document.addEventListener('click', (event) => {
                if (!panel.contains(event.target) && !toggle.contains(event.target)) {
                    closePanel();
                }
            });
        }

        // Mobile Menu
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeMobileMenuBtn = document.getElementById('closeMobileMenuBtn');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const mobileMenuDrawer = document.getElementById('mobileMenuDrawer');

        if (mobileMenuBtn && mobileMenuOverlay) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenuOverlay.classList.remove('hidden');
                // Trigger reflow
                void mobileMenuDrawer.offsetWidth;
                mobileMenuDrawer.classList.remove('translate-x-full');
            });

            const closeMobileMenu = () => {
                mobileMenuDrawer.classList.add('translate-x-full');
                setTimeout(() => {
                    mobileMenuOverlay.classList.add('hidden');
                }, 300);
            };

            closeMobileMenuBtn.addEventListener('click', closeMobileMenu);
            mobileMenuOverlay.addEventListener('click', (e) => {
                if (e.target === mobileMenuOverlay) closeMobileMenu();
            });
        }

        // Mobile Search
        const mobileSearchBtn = document.getElementById('mobileSearchBtn');
        const closeMobileSearchBtn = document.getElementById('closeMobileSearchBtn');
        const mobileSearchOverlay = document.getElementById('mobileSearchOverlay');

        if (mobileSearchBtn && mobileSearchOverlay) {
            mobileSearchBtn.addEventListener('click', () => {
                mobileSearchOverlay.classList.remove('hidden');
                mobileSearchOverlay.classList.add('flex');
            });
            closeMobileSearchBtn.addEventListener('click', () => {
                mobileSearchOverlay.classList.add('hidden');
                mobileSearchOverlay.classList.remove('flex');
            });
        }
    });
</script>
