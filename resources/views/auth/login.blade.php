<x-guest-layout>
    <x-slot name="title">Masuk</x-slot>

    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Selamat datang kembali! 👋</h2>
        <p class="text-gray-500 mt-1 text-sm">Masuk untuk melanjutkan ke akun Anda.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   placeholder="nama@email.com"
                   class="input-focus w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-sm transition placeholder-gray-400 @error('email') border-red-400 bg-red-50 @enderror">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-medium">Lupa password?</a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   placeholder="••••••••"
                   class="input-focus w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-sm transition placeholder-gray-400 @error('password') border-red-400 bg-red-50 @enderror">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center gap-2">
            <input id="remember_me" type="checkbox" name="remember"
                   class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
            <label for="remember_me" class="text-sm text-gray-600 cursor-pointer">Ingat saya</label>
        </div>

        <!-- Login Button -->
        <button type="submit"
                class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-200 shadow-md hover:shadow-lg text-sm">
            Masuk
        </button>
    </form>

    <!-- Divider -->
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-xs">
            <span class="bg-white px-3 text-gray-400 font-medium">Belum punya akun?</span>
        </div>
    </div>

    <!-- Register Button -->
    <a href="{{ route('register') }}"
       class="w-full flex items-center justify-center py-3 px-4 border-2 border-indigo-200 hover:border-indigo-500 hover:bg-indigo-50 text-indigo-600 font-semibold rounded-xl transition-all duration-200 text-sm gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
        Daftar Akun Baru
    </a>
</x-guest-layout>
