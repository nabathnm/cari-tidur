<x-guest-layout>
    <x-slot name="title">Daftar</x-slot>

    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Buat akun baru ✨</h2>
        <p class="text-gray-500 mt-1 text-sm">Daftar dan mulai temukan atau pasang kosan.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   placeholder="Nama Anda"
                   class="input-focus w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-sm transition placeholder-gray-400 @error('name') border-red-400 bg-red-50 @enderror">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   placeholder="nama@email.com"
                   class="input-focus w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-sm transition placeholder-gray-400 @error('email') border-red-400 bg-red-50 @enderror">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   placeholder="Min. 8 karakter"
                   class="input-focus w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-sm transition placeholder-gray-400 @error('password') border-red-400 bg-red-50 @enderror">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   placeholder="Ulangi password"
                   class="input-focus w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-sm transition placeholder-gray-400 @error('password_confirmation') border-red-400 bg-red-50 @enderror">
            @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Role Selection -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Daftar sebagai</label>
            @error('role')
                <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
            @enderror

            <div class="grid grid-cols-2 gap-3">
                <!-- Pencari Kosan -->
                <label for="role_user" id="card_user"
                       onclick="selectRole('user')"
                       class="role-card flex flex-col items-center justify-center gap-2 border-2 rounded-2xl p-4 cursor-pointer transition-all duration-200 border-indigo-500 bg-indigo-50">
                    <input id="role_user" type="radio" name="role" value="user" class="hidden" checked>
                    <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                        </svg>
                    </div>
                    <div class="text-center">
                        <div class="font-semibold text-gray-800 text-sm">Pencari Kosan</div>
                        <div class="text-xs text-gray-500 mt-0.5">Cari & sewa kosan</div>
                    </div>
                </label>

                <!-- Pemilik Kosan -->
                <label for="role_pemilik" id="card_pemilik"
                       onclick="selectRole('pemilik')"
                       class="role-card flex flex-col items-center justify-center gap-2 border-2 rounded-2xl p-4 cursor-pointer transition-all duration-200 border-gray-200 hover:border-emerald-300">
                    <input id="role_pemilik" type="radio" name="role" value="pemilik" class="hidden"
                        {{ old('role') === 'pemilik' ? 'checked' : '' }}>
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 4l9 5.75V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.75z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21V12h6v9"/>
                        </svg>
                    </div>
                    <div class="text-center">
                        <div class="font-semibold text-gray-800 text-sm">Pemilik Kosan</div>
                        <div class="text-xs text-gray-500 mt-0.5">Kelola & pasang kosan</div>
                    </div>
                </label>
            </div>
        </div>

        <!-- Register Button -->
        <button type="submit"
                class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-200 shadow-md hover:shadow-lg text-sm mt-2">
            Buat Akun
        </button>
    </form>

    <!-- Divider -->
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-xs">
            <span class="bg-white px-3 text-gray-400 font-medium">Sudah punya akun?</span>
        </div>
    </div>

    <a href="{{ route('login') }}"
       class="w-full flex items-center justify-center py-3 px-4 border-2 border-gray-200 hover:border-indigo-400 hover:bg-indigo-50 text-gray-600 hover:text-indigo-600 font-semibold rounded-xl transition-all duration-200 text-sm gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
        </svg>
        Masuk ke Akun
    </a>

    <script>
        // Restore selection on validation error
        @if(old('role') === 'pemilik')
        selectRole('pemilik');
        @endif

        function selectRole(role) {
            const cards = { user: document.getElementById('card_user'), pemilik: document.getElementById('card_pemilik') };
            const styles = {
                user:    { active: ['border-indigo-500','bg-indigo-50'],   inactive: ['border-gray-200','hover:border-emerald-300'] },
                pemilik: { active: ['border-emerald-500','bg-emerald-50'], inactive: ['border-gray-200','hover:border-indigo-300'] },
            };

            Object.keys(cards).forEach(key => {
                const card = cards[key];
                const isActive = key === role;
                card.classList.remove(
                    'border-indigo-500','bg-indigo-50',
                    'border-emerald-500','bg-emerald-50',
                    'border-gray-200','hover:border-emerald-300','hover:border-indigo-300'
                );
                card.classList.add(...(isActive ? styles[key].active : ['border-gray-200']));
                document.getElementById('role_' + key).checked = isActive;
            });
        }
    </script>
</x-guest-layout>
