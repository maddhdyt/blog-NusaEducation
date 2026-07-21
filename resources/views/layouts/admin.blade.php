<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Dashboard' }} - {{ config('app.name', 'Nusa Education') }}</title>
    @php
        $sidebarSetting = \App\Models\SidebarSetting::first();
        $siteLogo = optional($sidebarSetting)->site_logo_url ?: 'https://ik.imagekit.io/yqhp1cmbp/logo%20nusa%20education.png?tr=w-640,q-75,f-auto';
        $favicon = 'https://ik.imagekit.io/yqhp1cmbp/Logo%20Nusa%203%20(1).png?updatedAt=1783657933278';
    @endphp
    @if ($favicon)
        <link rel="icon" href="{{ $favicon }}" type="image/png">
        <link rel="apple-touch-icon" href="{{ $favicon }}">
    @endif

    <!-- NProgress CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
    <style>
        #nprogress .bar { background: #0a1435 !important; height: 3px !important; }
        #nprogress .peg { box-shadow: 0 0 10px #0a1435, 0 0 5px #0a1435 !important; }
        #nprogress .spinner-icon { border-top-color: #0a1435 !important; border-left-color: #0a1435 !important; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDF6F0] text-[#433836] font-sans">
    <div class="flex min-h-screen overflow-hidden" x-data="{ sidebarOpen: true }">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'ml-0' : '-ml-64'" class="w-64 shrink-0 bg-white border-r border-[#0a1435] flex flex-col transition-all duration-300 h-screen overflow-hidden">
            <div class="h-20 border-b border-[#0a1435] flex items-center justify-start px-4 shrink-0">
                <a href="{{ route('admin.dashboard') }}" class="inline-block">
                    <img src="{{ $siteLogo }}" alt="Nusa Education" class="h-14 w-auto">
                </a>
            </div>

            <nav class="p-4 overflow-y-auto flex-1">
                <!-- Utama -->
                <div class="mb-6">
                    <div class="px-4 mb-2 text-xs font-bold text-[#0a1435]/50 uppercase tracking-widest">Utama</div>
                    <div class="flex flex-col gap-1">
                        <a href="{{ route('admin.dashboard') }}"
                            class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'sidebar-link-active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            Dashboard
                        </a>
                    </div>
                </div>

                <!-- Konten -->
                <div class="mb-6">
                    <div class="px-4 mb-2 text-xs font-bold text-[#0a1435]/50 uppercase tracking-widest">Konten</div>
                    <div class="flex flex-col gap-1">
                        <a href="{{ route('admin.posts.index') }}"
                            class="sidebar-link {{ request()->routeIs('admin.posts.*') ? 'sidebar-link-active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                            Posts
                        </a>

                        <a href="{{ route('admin.categories.index') }}"
                            class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'sidebar-link-active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                            Categories
                        </a>

                        <a href="{{ route('admin.pages.index') }}"
                            class="sidebar-link {{ request()->routeIs('admin.pages.*') ? 'sidebar-link-active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Pages
                        </a>

                        <a href="{{ route('admin.galleries.index') }}"
                            class="sidebar-link {{ request()->routeIs('admin.galleries.*') ? 'sidebar-link-active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Gallery
                        </a>
                    </div>
                </div>

                <!-- Komunitas -->
                <div class="mb-6">
                    <div class="px-4 mb-2 text-xs font-bold text-[#0a1435]/50 uppercase tracking-widest">Komunitas</div>
                    <div class="flex flex-col gap-1">
                        <a href="{{ route('admin.subscribers.index') }}"
                            class="sidebar-link {{ request()->routeIs('admin.subscribers.*') ? 'sidebar-link-active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Subscribers
                        </a>

                        <a href="{{ route('admin.users.index') }}"
                            class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'sidebar-link-active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            Users
                        </a>
                    </div>
                </div>

                <!-- Pengaturan -->
                <div class="mb-6">
                    <div class="px-4 mb-2 text-xs font-bold text-[#0a1435]/50 uppercase tracking-widest">Pengaturan</div>
                    <div class="flex flex-col gap-1">
                        <a href="{{ route('admin.menus.index') }}"
                            class="sidebar-link {{ request()->routeIs('admin.menus.*') ? 'sidebar-link-active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            Menus
                        </a>

                        <a href="{{ route('admin.sidebar-settings.edit') }}"
                            class="sidebar-link {{ request()->routeIs('admin.sidebar-settings.*') ? 'sidebar-link-active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Sidebar Settings
                        </a>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden h-screen">
            <!-- Header -->
            <header class="bg-[#FDF6F0] border-b border-[#0a1435] h-20 shrink-0">
                <div class="flex items-center justify-between px-8 h-full">
                    <div class="flex items-center gap-4">
                        <button @click="sidebarOpen = !sidebarOpen" class="text-[#0a1435] hover:text-brand-primary transition-colors focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <h1 class="text-3xl font-heading text-[#0a1435] tracking-tight">@yield('page_title', 'Dashboard')</h1>
                    </div>

                    <div class="flex items-center gap-6">
                        <a href="{{ route('home') }}" target="_blank"
                            class="text-sm font-bold uppercase tracking-wider text-[#0a1435] hover:text-brand-primary transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            View Site
                        </a>
                        
                        <div class="h-6 w-px bg-[#0a1435]"></div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full border border-[#0a1435] bg-white flex items-center justify-center text-[#0a1435] font-bold">
                                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm font-bold uppercase tracking-wider text-[#0a1435] hover:text-red-600 transition-colors">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6 overflow-y-auto overflow-x-hidden">
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-green-100 border border-[#0a1435] text-[#0a1435] font-semibold text-sm flex justify-between items-center">
                        <span>{{ session('success') }}</span>
                        <button @click="show = false" class="text-[#0a1435] hover:text-black focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-red-100 border border-red-700 text-red-700 font-semibold text-sm flex justify-between items-center">
                        <span>{{ session('error') }}</span>
                        <button @click="show = false" class="text-red-700 hover:text-black focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-red-100 border border-red-700 text-red-700 font-semibold text-sm flex justify-between items-start">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button @click="show = false" class="text-red-700 hover:text-black focus:outline-none mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- NProgress JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            NProgress.configure({ showSpinner: false });
            document.querySelectorAll('a').forEach(function(anchor) {
                anchor.addEventListener('click', function(e) {
                    if (anchor.href && !anchor.href.startsWith('#') && !anchor.href.startsWith('javascript:') && anchor.target !== '_blank' && !e.ctrlKey && !e.metaKey) {
                        NProgress.start();
                    }
                });
            });
        });
        window.addEventListener('pageshow', function() { NProgress.done(); });
    </script>
    
    @stack('scripts')
</body>

</html>
