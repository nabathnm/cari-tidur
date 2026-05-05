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
            body { font-family: 'Inter', sans-serif; }
            .auth-gradient {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            }
            .glass-card {
                background: rgba(255,255,255,0.97);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
            }
            .input-focus:focus {
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102,126,234,0.15);
                outline: none;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex auth-gradient">

            <!-- Left Panel — Branding -->
            <div class="hidden lg:flex lg:w-1/2 flex-col items-center justify-center px-16 text-white">
                <div class="max-w-md text-center">
                    <div class="w-20 h-20 bg-white/20 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 9.75L12 4l9 5.75V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.75z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21V12h6v9"/>
                        </svg>
                    </div>
                    <h1 class="text-5xl font-extrabold mb-4 tracking-tight">CariTidur</h1>
                    <p class="text-xl text-white/80 leading-relaxed mb-10">
                        Platform terpercaya untuk menemukan & mengelola kosan dengan mudah.
                    </p>
                    <div class="grid grid-cols-3 gap-6 text-center">
                        <div class="bg-white/10 rounded-2xl p-4">
                            <div class="text-3xl font-bold">500+</div>
                            <div class="text-sm text-white/70 mt-1">Kosan Tersedia</div>
                        </div>
                        <div class="bg-white/10 rounded-2xl p-4">
                            <div class="text-3xl font-bold">10K+</div>
                            <div class="text-sm text-white/70 mt-1">Pengguna Aktif</div>
                        </div>
                        <div class="bg-white/10 rounded-2xl p-4">
                            <div class="text-3xl font-bold">50+</div>
                            <div class="text-sm text-white/70 mt-1">Kota</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel — Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12 bg-gray-50">
                <div class="glass-card w-full max-w-md rounded-3xl shadow-2xl px-8 py-10">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 9.75L12 4l9 5.75V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.75z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21V12h6v9"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-800">CariTidur</span>
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
