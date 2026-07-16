<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' - ' . config('app.name', 'Nusa Education') : config('app.name', 'Nusa Education') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="https://ik.imagekit.io/yqhp1cmbp/Logo%20Nusa%203%20(1).png?updatedAt=1783657933278" type="image/png">
        <link rel="apple-touch-icon" href="https://ik.imagekit.io/yqhp1cmbp/Logo%20Nusa%203%20(1).png?updatedAt=1783657933278">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
        
        <style>
            @font-face {
                font-family: 'Feature';
                src: local('Georgia'), local('Times New Roman'), serif;
            }
            .font-heading { font-family: 'Feature', serif; }
            .font-sans { font-family: 'DM Sans', sans-serif; }
            .text-brand-primary { color: #1786F8; }
            .bg-brand-primary { background-color: #1786F8; }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-[#433836] bg-white">
        <div class="min-h-screen flex flex-col justify-center items-center py-12 sm:px-6 lg:px-8">
            <div class="w-full sm:max-w-md px-6 py-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
