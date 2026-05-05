<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CariTidur') }} — {{ $title ?? 'Auth' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Inter', sans-serif; background: #f8fafc; }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col items-center justify-center px-4 py-12"
             style="background: linear-gradient(160deg, #f0fdf4 0%, #f8fafc 50%, #eff6ff 100%);">

            <!-- Logo / Brand -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 mb-8 group">
                <div class="w-11 h-11 rounded-2xl flex items-center justify-center shadow-sm"
                     style="background: linear-gradient(135deg, #16a34a, #15803d);">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 4l9 5.75V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.75z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 21V12h6v9"/>
                    </svg>
                </div>
                <span class="text-xl font-bold text-gray-800 group-hover:text-green-700 transition-colors">CariTidur</span>
            </a>

            <!-- Card -->
            <div class="w-full max-w-md bg-white rounded-3xl shadow-lg border border-gray-100 px-8 py-9">
                {{ $slot }}
            </div>

            <!-- Footer note -->
            <p class="text-xs text-gray-400 mt-6">© {{ date('Y') }} CariTidur. Semua hak dilindungi.</p>
        </div>
    </body>
</html>
