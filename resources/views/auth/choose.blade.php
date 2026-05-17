<x-guest-layout>
    <x-slot name="title">Selamat Datang</x-slot>

    <div class="text-center mb-8">
        <h2 class="text-2xl font-extrabold text-gray-900 mb-2">Selamat Datang!</h2>
        <p class="text-sm text-gray-500">Mulai temukan kos impianmu atau kelola propertimu bersama kami.</p>
    </div>

    <div class="space-y-4">
        <!-- Login Option -->
        <a href="{{ route('login') }}"
           class="group relative flex items-center justify-between p-4 rounded-2xl border border-gray-100 hover:border-green-300 bg-gray-50 hover:bg-green-50/50 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center text-green-600 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                </div>
                <div class="text-left">
                    <h3 class="font-bold text-gray-800 group-hover:text-green-700 transition-colors">Masuk</h3>
                    <p class="text-xs text-gray-500">Sudah punya akun? Masuk di sini.</p>
                </div>
            </div>
            <div class="w-8 h-8 rounded-full flex items-center justify-center bg-white shadow-sm group-hover:bg-green-600 transition-colors">
                <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </a>

        <!-- Register Option -->
        <a href="{{ route('register') }}"
           class="group relative flex items-center justify-between p-4 rounded-2xl border border-gray-100 hover:border-green-300 bg-gray-50 hover:bg-green-50/50 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center text-green-600 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <div class="text-left">
                    <h3 class="font-bold text-gray-800 group-hover:text-green-700 transition-colors">Daftar Baru</h3>
                    <p class="text-xs text-gray-500">Belum bergabung? Daftar sekarang.</p>
                </div>
            </div>
            <div class="w-8 h-8 rounded-full flex items-center justify-center bg-white shadow-sm group-hover:bg-green-600 transition-colors">
                <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </a>
    </div>
    
    <div class="mt-8 text-center relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-100"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-3 bg-white text-gray-400 font-medium">Atau</span>
        </div>
    </div>
    
    <a href="{{ route('home') }}" class="mt-6 group w-full flex items-center justify-center gap-2 py-3.5 px-4 border border-gray-200 rounded-xl text-sm font-semibold text-gray-600 hover:border-green-600 hover:text-green-600 transition-all duration-300 shadow-sm hover:shadow">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        Telusuri Kosan Tanpa Login
    </a>
</x-guest-layout>