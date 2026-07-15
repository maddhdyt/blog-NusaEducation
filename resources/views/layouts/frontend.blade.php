<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    @php
        $sidebarSetting = \App\Models\SidebarSetting::first();
        $favicon = optional($sidebarSetting)->site_logo_url ?: asset('favicon.ico');
    @endphp
    @if ($favicon)
        <link rel="icon" href="{{ $favicon }}" type="image/png">
        <link rel="apple-touch-icon" href="{{ $favicon }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900 font-sans antialiased">
    @if (empty($hideNavbar))
        @include('frontend.partials.navbar')
    @endif

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('frontend.partials.footer')
    @stack('scripts')
</body>

</html>
