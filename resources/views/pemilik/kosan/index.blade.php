<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-base text-gray-800">Kelola Kosan</h2>
            <a href="{{ route('pemilik.kosan.create') }}"
               class="inline-flex items-center gap-1.5 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition"
               style="background:linear-gradient(135deg,#16a34a,#15803d)">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Kosan
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">

            @if(session('success'))
                <div class="mb-3 flex items-center gap-2 bg-green-50 border border-green-200 text-green-800 text-xs px-3 py-2 rounded-lg">
                    <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($kosans->isEmpty())
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm py-10 text-center">
                    <div class="text-4xl mb-2">🏠</div>
                    <h3 class="text-sm font-semibold text-gray-700 mb-1">Belum ada kosan</h3>
                    <p class="text-gray-400 text-xs mb-4">Mulai tambahkan kosan pertama Anda.</p>
                    <a href="{{ route('pemilik.kosan.create') }}"
                       class="inline-flex items-center gap-1.5 text-white text-xs font-semibold px-4 py-2 rounded-lg"
                       style="background:linear-gradient(135deg,#16a34a,#15803d)">
                        + Tambah Kosan
                    </a>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                    @foreach($kosans as $kosan)
                        <div class="bg-white rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                            {{-- Foto --}}
                            @if($kosan->fotoUtama)
                                <img src="{{ asset('storage/' . $kosan->fotoUtama->foto) }}"
                                     alt="{{ $kosan->nama_kosan }}"
                                     class="w-full h-24 object-cover">
                            @else
                                <div class="w-full h-24 bg-gray-100 flex items-center justify-center text-gray-300">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif

                            <div class="p-2.5">
                                {{-- Status + Tipe --}}
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-[10px] font-semibold px-1.5 py-0.5 rounded
                                        {{ $kosan->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                        {{ ucfirst($kosan->status) }}
                                    </span>
                                    <span class="text-[10px] text-gray-400 capitalize">{{ $kosan->tipe }}</span>
                                </div>

                                <p class="font-semibold text-gray-800 text-xs truncate leading-tight">{{ $kosan->nama_kosan }}</p>
                                <p class="text-[10px] text-gray-400 mt-0.5">{{ $kosan->kota }}</p>
                                <p class="text-xs font-bold text-green-700 mt-1">
                                    Rp {{ number_format($kosan->harga_per_bulan, 0, ',', '.') }}
                                    <span class="text-[10px] font-normal text-gray-400">/bln</span>
                                </p>
                                <p class="text-[10px] text-gray-400 mt-0.5">{{ $kosan->kamar_tersedia }}/{{ $kosan->jumlah_kamar }} kamar</p>

                                {{-- Aksi --}}
                                <div class="flex gap-1 mt-2">
                                    <a href="{{ route('pemilik.kosan.show', $kosan) }}"
                                       class="flex-1 text-center text-[10px] font-semibold py-1 rounded bg-gray-100 hover:bg-gray-200 text-gray-700 transition">Detail</a>
                                    <a href="{{ route('pemilik.kosan.edit', $kosan) }}"
                                       class="flex-1 text-center text-[10px] font-semibold py-1 rounded bg-blue-50 hover:bg-blue-100 text-blue-700 transition">Edit</a>
                                    <form action="{{ route('pemilik.kosan.destroy', $kosan) }}" method="POST"
                                          onsubmit="return confirm('Hapus kosan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="text-[10px] font-semibold py-1 px-1.5 rounded bg-red-50 hover:bg-red-100 text-red-600 transition">✕</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
