<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' . config('app.name', 'Nusa Education') : config('app.name', 'Nusa Education') }}</title>
    <meta name="description" content="@yield('meta_description', 'Blog Nusa Education - Wawasan & Strategi Digital Terkini.')">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph / Social -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ isset($title) ? $title . ' - ' . config('app.name', 'Nusa Education') : config('app.name', 'Nusa Education') }}">
    <meta property="og:description" content="@yield('meta_description', 'Blog Nusa Education - Wawasan & Strategi Digital Terkini.')">
    <meta property="og:image" content="@yield('og_image', 'https://ik.imagekit.io/yqhp1cmbp/Logo%20Nusa%203%20(1).png?updatedAt=1783657933278')">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ isset($title) ? $title . ' - ' . config('app.name', 'Nusa Education') : config('app.name', 'Nusa Education') }}">
    <meta property="twitter:description" content="@yield('meta_description', 'Blog Nusa Education - Wawasan & Strategi Digital Terkini.')">
    <meta property="twitter:image" content="@yield('og_image', 'https://ik.imagekit.io/yqhp1cmbp/Logo%20Nusa%203%20(1).png?updatedAt=1783657933278')">

    @yield('meta')
    @yield('structured_data')

    @php
        $favicon = 'https://ik.imagekit.io/yqhp1cmbp/Logo%20Nusa%203%20(1).png?updatedAt=1783657933278';
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
