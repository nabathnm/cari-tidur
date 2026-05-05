<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cari Kosan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($kosans as $kosan)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        @if($kosan->fotoUtama)
                            <img src="{{ asset('storage/' . $kosan->fotoUtama->foto) }}" alt="{{ $kosan->nama_kosan }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">Tidak ada foto</div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2">{{ $kosan->nama_kosan }}</h3>
                            <p class="text-gray-700 text-sm mb-2">{{ $kosan->kota }} - {{ ucfirst($kosan->tipe) }}</p>
                            <p class="text-blue-600 font-bold">Rp {{ number_format($kosan->harga_per_bulan, 0, ',', '.') }} / bulan</p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-xs text-gray-500">Sisa {{ $kosan->kamar_tersedia }} kamar</span>
                                <a href="#" class="text-blue-500 hover:text-blue-700 text-sm font-semibold">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 bg-white p-6 rounded-lg shadow-sm text-center text-gray-500">
                        Belum ada kosan yang tersedia.
                    </div>
                @endforelse
            </div>
            <div class="mt-6">
                {{ $kosans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
