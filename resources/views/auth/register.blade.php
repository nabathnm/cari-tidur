<x-guest-layout>
    <x-slot name="title">Daftar Akun</x-slot>

    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Buat akun baru</h2>
        <p class="text-gray-500 mt-1 text-sm">Isi data di bawah untuk mulai menggunakan CariTidur.</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   required autofocus autocomplete="name" placeholder="Nama lengkap Anda"
                   class="w-full px-4 py-2.5 rounded-lg border {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} text-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent transition">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   required autocomplete="username" placeholder="nama@email.com"
                   class="w-full px-4 py-2.5 rounded-lg border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} text-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent transition">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
            <input id="password" type="password" name="password"
                   required autocomplete="new-password" placeholder="Minimal 8 karakter"
                   class="w-full px-4 py-2.5 rounded-lg border {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} text-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent transition">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-5">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   required autocomplete="new-password" placeholder="Ulangi password"
                   class="w-full px-4 py-2.5 rounded-lg border {{ $errors->has('password_confirmation') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} text-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent transition">
            @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Role Selection -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Daftar sebagai</label>
            @error('role')
                <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
            @enderror

            <div class="grid grid-cols-2 gap-3">
                <!-- Pencari Kosan -->
                <label for="role_user"
                       class="flex flex-col items-center gap-2 border-2 rounded-xl p-4 cursor-pointer transition-all duration-150
                              {{ old('role', 'user') === 'user' ? 'border-green-500 bg-green-50' : 'border-gray-200 hover:border-green-300 bg-white' }}">
                    <input type="radio" id="role_user" name="role" value="user"
                           @checked(old('role', 'user') === 'user') class="sr-only">
                    <span class="text-2xl">🔍</span>
                    <span class="text-sm font-semibold text-gray-800">Pencari Kosan</span>
                    <span class="text-xs text-gray-500 text-center">Cari &amp; sewa kosan</span>
                </label>

                <!-- Pemilik Kosan -->
                <label for="role_pemilik"
                       class="flex flex-col items-center gap-2 border-2 rounded-xl p-4 cursor-pointer transition-all duration-150
                              {{ old('role') === 'pemilik' ? 'border-green-500 bg-green-50' : 'border-gray-200 hover:border-green-300 bg-white' }}">
                    <input type="radio" id="role_pemilik" name="role" value="pemilik"
                           @checked(old('role') === 'pemilik') class="sr-only">
                    <span class="text-2xl">🏠</span>
                    <span class="text-sm font-semibold text-gray-800">Pemilik Kosan</span>
                    <span class="text-xs text-gray-500 text-center">Kelola &amp; pasang kosan</span>
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full py-3 text-white font-bold rounded-xl text-sm transition-all duration-200 shadow-sm hover:shadow-md active:scale-95"
                style="background: linear-gradient(135deg, #16a34a, #15803d);">
            Buat Akun Sekarang
        </button>
    </form>

    <!-- Link ke Login -->
    <div class="mt-6 text-center text-sm text-gray-500">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-semibold text-green-600 hover:text-green-800 ml-1">Masuk di sini</a>
    </div>

    <!-- JavaScript: highlight kartu saat diklik -->
    <script>
        document.querySelectorAll('input[name="role"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                document.querySelectorAll('input[name="role"]').forEach(function(r) {
                    var card = r.closest('label');
                    card.classList.remove('border-green-500', 'bg-green-50');
                    card.classList.add('border-gray-200', 'bg-white');
                });
                var activeCard = this.closest('label');
                activeCard.classList.remove('border-gray-200', 'bg-white');
                activeCard.classList.add('border-green-500', 'bg-green-50');
            });
        });
    </script>
</x-guest-layout>