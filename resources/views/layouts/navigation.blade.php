<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">

            {{-- Logo + Nav Links --}}
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center" style="background:linear-gradient(135deg,#16a34a,#15803d)">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 4l9 5.75V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.75z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 21V12h6v9"/>
                        </svg>
                    </div>
                    <span class="font-bold text-gray-800 text-sm">CariTidur</span>
                </a>

                <div class="hidden sm:flex items-center gap-1">
                    <a href="{{ route('home') }}"
                       class="px-3 py-1.5 rounded-lg text-sm font-medium transition
                              {{ request()->routeIs('home') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        Beranda
                    </a>
                    @auth
                        @if(Auth::user()->role === 'pemilik')
                            <a href="{{ route('pemilik.dashboard') }}"
                               class="px-3 py-1.5 rounded-lg text-sm font-medium transition
                                      {{ request()->routeIs('pemilik.dashboard') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('pemilik.kosan.index') }}"
                               class="px-3 py-1.5 rounded-lg text-sm font-medium transition
                                      {{ request()->routeIs('pemilik.kosan.*') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                Kelola Kosan
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}"
                               class="px-3 py-1.5 rounded-lg text-sm font-medium transition
                                      {{ request()->routeIs('user.dashboard') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                Pesanan Saya
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- Right: Auth --}}
            <div class="hidden sm:flex items-center gap-2">
                @auth
                    <span class="text-xs text-gray-400 mr-1">{{ Auth::user()->name }}</span>
                    <x-dropdown align="right" width="44">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 border border-gray-200 transition">
                                <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-bold text-xs">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <svg class="w-3 h-3 text-gray-400" fill="none" viewBox="0 0 20 20" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8l5 5 5-5"/></svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-xs font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                            </div>
                            <x-dropdown-link :href="route('profile.edit')">Profil</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Keluar
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                       class="px-3 py-1.5 text-sm font-semibold text-gray-700 hover:text-gray-900 rounded-lg hover:bg-gray-50 transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-3 py-1.5 text-sm font-semibold text-white rounded-lg transition"
                       style="background:linear-gradient(135deg,#16a34a,#15803d)">
                        Daftar
                    </a>
                @endauth
            </div>

            {{-- Hamburger --}}
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition">
                    <svg class="w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden border-t border-gray-100 bg-white">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-sm rounded-lg {{ request()->routeIs('home') ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-700' }}">Beranda</a>
            @auth
                @if(Auth::user()->role === 'pemilik')
                    <a href="{{ route('pemilik.dashboard') }}" class="block px-3 py-2 text-sm rounded-lg text-gray-700">Dashboard</a>
                    <a href="{{ route('pemilik.kosan.index') }}" class="block px-3 py-2 text-sm rounded-lg text-gray-700">Kelola Kosan</a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="block px-3 py-2 text-sm rounded-lg text-gray-700">Pesanan Saya</a>
                @endif
                <div class="border-t border-gray-100 pt-2 mt-2">
                    <p class="px-3 text-xs text-gray-400">{{ Auth::user()->name }}</p>
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-sm text-gray-700 rounded-lg">Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 text-sm text-red-600 rounded-lg">Keluar</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="block px-3 py-2 text-sm text-gray-700 rounded-lg">Masuk</a>
                <a href="{{ route('register') }}" class="block px-3 py-2 text-sm text-green-700 font-semibold rounded-lg">Daftar</a>
            @endauth
        </div>
    </div>
</nav>
