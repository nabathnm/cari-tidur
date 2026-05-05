<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">{{ __('Selamat Datang') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-4xl">
            <!-- Login Card -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">{{ __('Masuk') }}</h3>
                <p class="text-gray-600 mb-6">Jika Anda sudah memiliki akun, silakan masuk.</p>
                <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    {{ __('Login') }}
                </a>
            </div>
            <!-- Register Card -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">{{ __('Daftar') }}</h3>
                <p class="text-gray-600 mb-6">Jika Anda belum memiliki akun, silakan daftar.</p>
                <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                    {{ __('Register') }}
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
