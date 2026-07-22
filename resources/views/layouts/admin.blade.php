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
        [x-cloak] { display: none !important; }
        #nprogress .bar { background: #0a1435 !important; height: 3px !important; }
        #nprogress .peg { box-shadow: 0 0 10px #0a1435, 0 0 5px #0a1435 !important; }
        #nprogress .spinner-icon { border-top-color: #0a1435 !important; border-left-color: #0a1435 !important; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDF6F0] text-[#433836] font-sans">
    <div class="flex min-h-screen overflow-hidden" x-data="{ mobileOpen: false, desktopCollapsed: false }">

        <!-- Mobile Overlay -->
        <div x-show="mobileOpen" 
             @click="mobileOpen = false" 
             style="display: none;"
             x-transition.opacity
             class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 lg:hidden">
        </div>

        <!-- Mobile Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-[#0a1435] flex flex-col h-full lg:hidden shrink-0 transition-transform duration-300"
               style="transform: translateX(-100%);"
               :style="mobileOpen ? 'transform: translateX(0);' : 'transform: translateX(-100%);'">
            @include('layouts.partials.admin-sidebar')
        </aside>

        <!-- Desktop Sidebar -->
        <aside class="hidden lg:flex w-64 bg-white border-r border-[#0a1435] flex-col h-screen shrink-0 transition-all duration-300"
               style="margin-left: 0;"
               :style="desktopCollapsed ? 'margin-left: -16rem;' : 'margin-left: 0;'">
            @include('layouts.partials.admin-sidebar')
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden h-screen min-w-0 transition-all duration-300">
            <!-- Header -->
            <header class="bg-[#FDF6F0] border-b border-[#0a1435] h-16 md:h-20 shrink-0">
                <div class="flex items-center justify-between px-4 md:px-8 h-full">
                    <div class="flex items-center gap-3 md:gap-4 min-w-0">
                        <button @click="mobileOpen = !mobileOpen" class="lg:hidden text-[#0a1435] hover:text-brand-primary transition-colors focus:outline-none shrink-0 p-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <button @click="desktopCollapsed = !desktopCollapsed" class="hidden lg:block text-[#0a1435] hover:text-brand-primary transition-colors focus:outline-none shrink-0 p-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <h1 class="text-lg sm:text-xl md:text-3xl font-heading text-[#0a1435] tracking-tight truncate">@yield('page_title', 'Dashboard')</h1>
                    </div>

                    <div class="flex items-center gap-3 md:gap-6 shrink-0">
                        <a href="{{ route('home') }}" target="_blank"
                            class="text-xs md:text-sm font-bold uppercase tracking-wider text-[#0a1435] hover:text-brand-primary transition-colors flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            <span class="hidden sm:inline">View Site</span>
                        </a>
                        
                        <div class="h-5 md:h-6 w-px bg-[#0a1435]"></div>

                        <div class="flex items-center gap-2 md:gap-3">
                            <div class="w-7 h-7 md:w-8 md:h-8 rounded-full border border-[#0a1435] bg-white flex items-center justify-center text-[#0a1435] font-bold text-xs md:text-sm shrink-0">
                                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                            </div>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" onsubmit="confirmLogout(event, this)">
                                @csrf
                                <button type="submit" class="text-xs md:text-sm font-bold uppercase tracking-wider text-[#0a1435] hover:text-red-600 transition-colors flex items-center gap-1">
                                    <span class="hidden sm:inline">Logout</span>
                                    <svg class="w-4 h-4 sm:hidden text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-4 md:p-6 overflow-y-auto overflow-x-hidden">
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

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmLogout(event, formElement) {
            event.preventDefault();
            Swal.fire({
                title: 'Keluar dari Admin?',
                text: 'Anda akan dialihkan ke halaman login.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0a1435',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal',
                background: '#ffffff',
                customClass: {
                    title: 'text-[#0a1435] font-bold',
                    popup: 'border border-[#0a1435]',
                    confirmButton: 'font-bold tracking-wider rounded-none border border-[#0a1435]',
                    cancelButton: 'font-bold tracking-wider rounded-none'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    formElement.submit();
                }
            });
        }

        function confirmDelete(event, formElement, title = 'Apakah Anda yakin?', message = 'Data yang dihapus tidak dapat dikembalikan!') {
            event.preventDefault();
            Swal.fire({
                title: title,
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#0a1435',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                background: '#ffffff',
                customClass: {
                    title: 'text-[#0a1435] font-bold',
                    popup: 'border border-[#0a1435]',
                    confirmButton: 'font-bold tracking-wider rounded-none',
                    cancelButton: 'font-bold tracking-wider rounded-none border border-[#0a1435]'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    formElement.submit();
                }
            });
        }

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
