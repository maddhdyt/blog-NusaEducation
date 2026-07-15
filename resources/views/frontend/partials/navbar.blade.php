@php
    $menus = \App\Models\Menu::active()->parentOnly()->with('children')->orderBy('order')->get();
    $sidebarSetting = \App\Models\SidebarSetting::first();
@endphp

<nav class="bg-white/95 backdrop-blur shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    @if (optional($sidebarSetting)->site_logo_url)
                        <img src="{{ $sidebarSetting->site_logo_url }}" alt="{{ config('app.name') }}" class="h-10 w-auto">
                    @else
                        <span class="text-2xl font-bold text-blue-600">{{ config('app.name') }}</span>
                    @endif
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-6">
                @foreach ($menus as $menu)
                    @if ($menu->children->isEmpty())
                        <a href="{{ $menu->getUrl() }}" class="text-sm font-semibold text-gray-900 hover:text-blue-600">
                            {{ $menu->title }}
                        </a>
                    @else
                        <div class="relative group">
                            <button type="button"
                                class="flex items-center gap-1 text-sm font-semibold text-gray-900 hover:text-blue-600">
                                {{ $menu->title }}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="h-4 w-4 text-gray-500">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.25a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div
                                class="absolute left-1/2 top-full mt-4 w-[520px] -translate-x-1/2 rounded-2xl border border-gray-100 bg-white shadow-2xl ring-1 ring-gray-900/5 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-focus-within:opacity-100 group-focus-within:visible transition z-50">
                                <div class="p-4 sm:p-6 space-y-4">
                                    @foreach ($menu->children as $child)
                                        <a href="{{ $child->getUrl() }}"
                                            class="flex items-start gap-4 rounded-xl p-3 hover:bg-gray-50 transition">
                                            <span
                                                class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-500 ring-1 ring-gray-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="1.5"
                                                    class="h-6 w-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.75 3.75h10.5a3 3 0 0 1 3 3v10.5a3 3 0 0 1-3 3H6.75a3 3 0 0 1-3-3V6.75a3 3 0 0 1 3-3Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 9h6M9 12h6M9 15h3" />
                                                </svg>
                                            </span>
                                            <span class="flex flex-col gap-1">
                                                <span
                                                    class="text-sm font-semibold text-gray-900">{{ $child->title }}</span>
                                                <span
                                                    class="text-sm text-gray-500 leading-6">{{ $child->description ?? 'Learn more about ' . $child->title }}</span>
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="hidden md:flex items-center space-x-4">
                <div class="relative">
                    <button type="button" id="navSearchToggle"
                        class="p-2 rounded-full text-gray-700 hover:text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="Cari artikel">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 5 5a7.5 7.5 0 0 0 11.65 11.65Z" />
                        </svg>
                    </button>

                    <div id="navSearchPanel"
                        class="hidden absolute right-0 mt-3 w-80 rounded-2xl bg-white p-4 shadow-2xl ring-1 ring-gray-900/5">
                        <form action="{{ route('posts.search') }}" method="GET" class="space-y-3">
                            <div class="flex items-center gap-2">
                                <input type="text" name="q" placeholder="Cari artikel..." autocomplete="off"
                                    class="flex-1 rounded-lg border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <button type="submit"
                                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-3 py-2 text-white font-semibold hover:bg-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 5 5a7.5 7.5 0 0 0 11.65 11.65Z" />
                                    </svg>
                                    Cari
                                </button>
                            </div>
                            <p class="text-xs text-gray-500">Cari artikel terbaru dan populer.</p>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="text-gray-700 hover:text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('navSearchToggle');
        const panel = document.getElementById('navSearchPanel');

        if (!toggle || !panel) return;

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
    });
</script>
