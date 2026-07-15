<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    @php
        $themeSetting = \App\Models\SidebarSetting::first();
        $theme = [
            'primary' => optional($themeSetting)->theme_primary_color ?? '#4f46e5',
            'primaryStrong' => optional($themeSetting)->theme_primary_strong_color ?? '#4338ca',
            'primarySoft' => optional($themeSetting)->theme_primary_soft_color ?? '#eef2ff',
            'background' => optional($themeSetting)->theme_background_color ?? '#f9fafb',
            'card' => optional($themeSetting)->theme_card_color ?? '#ffffff',
            'text' => optional($themeSetting)->theme_text_color ?? '#111827',
            'textMuted' => optional($themeSetting)->theme_text_muted_color ?? '#4b5563',
            'border' => optional($themeSetting)->theme_border_color ?? '#e5e7eb',
        ];
    @endphp
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --theme-primary: {{ $theme['primary'] }};
            --theme-primary-strong: {{ $theme['primaryStrong'] }};
            --theme-primary-soft: {{ $theme['primarySoft'] }};
            --theme-background: {{ $theme['background'] }};
            --theme-card: {{ $theme['card'] }};
            --theme-text: {{ $theme['text'] }};
            --theme-text-muted: {{ $theme['textMuted'] }};
            --theme-border: {{ $theme['border'] }};
        }

        body {
            background-color: var(--theme-background);
            color: var(--theme-text);
        }

        .bg-white {
            background-color: var(--theme-card) !important;
        }

        .bg-gray-50 {
            background-color: var(--theme-background) !important;
        }

        .text-gray-900 {
            color: var(--theme-text) !important;
        }

        .text-gray-600,
        .text-gray-500 {
            color: var(--theme-text-muted) !important;
        }

        .border-gray-200,
        .ring-gray-100 {
            border-color: var(--theme-border) !important;
        }

        .text-indigo-600,
        .text-indigo-700,
        .text-blue-600,
        .hover\:text-blue-600:hover,
        .hover\:text-indigo-700:hover {
            color: var(--theme-primary) !important;
        }

        .bg-indigo-600,
        .bg-indigo-500,
        .bg-blue-600 {
            background-color: var(--theme-primary) !important;
        }

        .hover\:bg-indigo-500:hover,
        .hover\:bg-indigo-600:hover,
        .hover\:bg-blue-600:hover {
            background-color: var(--theme-primary-strong) !important;
        }

        .bg-indigo-50,
        .bg-blue-50 {
            background-color: var(--theme-primary-soft) !important;
        }

        .border-indigo-100 {
            border-color: var(--theme-border) !important;
        }
    </style>
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
