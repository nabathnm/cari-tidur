<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-base text-gray-800">Dashboard</h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 space-y-4">

            {{-- Greeting --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-4 py-3 flex items-center justify-between">
                <div>
                    <p class="font-semibold text-gray-900 text-sm">Selamat datang, {{ Auth::user()->name }} 👋</p>
                    <p class="text-gray-400 text-xs mt-0.5">Kelola kosan Anda dari sini.</p>
                </div>
                <a href="{{ route('pemilik.kosan.create') }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 text-white text-xs font-semibold rounded-lg transition"
                   style="background:linear-gradient(135deg,#16a34a,#15803d)">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Kosan
                </a>
            </div>

            {{-- Stats: 4 kolom kompak --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                @php
                    $stats = [
                        ['label'=>'Total Kosan',        'value'=>$totalKosan ?? 0,         'color'=>'text-green-600',  'bg'=>'bg-green-50',  'icon'=>'M3 9.75L12 4l9 5.75V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.75zM9 21V12h6v9'],
                        ['label'=>'Total Pesanan',       'value'=>$totalPemesanan ?? 0,     'color'=>'text-blue-600',   'bg'=>'bg-blue-50',   'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                        ['label'=>'Menunggu Konfirmasi', 'value'=>$pemesananPending ?? 0,   'color'=>'text-yellow-600', 'bg'=>'bg-yellow-50', 'icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['label'=>'Kamar Tersedia',      'value'=>$totalKamarTersedia ?? 0, 'color'=>'text-purple-600', 'bg'=>'bg-purple-50', 'icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ];
                @endphp
                @foreach($stats as $stat)
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-3 py-3 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg {{ $stat['bg'] }} flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 {{ $stat['color'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                @foreach(explode('M', $stat['icon']) as $i => $d)
                                    @if($i > 0)<path stroke-linecap="round" stroke-linejoin="round" d="M{{ $d }}"/>@endif
                                @endforeach
                            </svg>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-gray-900 leading-none">{{ $stat['value'] }}</p>
                            <p class="text-[10px] text-gray-400 mt-0.5">{{ $stat['label'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Kosan Terbaru --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="font-semibold text-gray-800 text-sm">Kosan Saya</h4>
                    <a href="{{ route('pemilik.kosan.index') }}" class="text-[11px] text-green-600 hover:text-green-800 font-semibold">Lihat Semua →</a>
                </div>

                @if(isset($kosanTerbaru) && $kosanTerbaru->count())
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2.5">
                        @foreach($kosanTerbaru as $kosan)
                            <a href="{{ route('pemilik.kosan.show', $kosan) }}"
                               class="group block rounded-lg border border-gray-100 overflow-hidden hover:shadow-sm transition-shadow">
                                @if($kosan->fotoUtama)
                                    <img src="{{ asset('storage/' . $kosan->fotoUtama->foto) }}"
                                         alt="{{ $kosan->nama_kosan }}"
                                         class="w-full h-20 object-cover group-hover:opacity-90 transition-opacity">
                                @else
                                    <div class="w-full h-20 bg-gray-100 flex items-center justify-center text-gray-300">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                                <div class="p-1.5">
                                    <p class="text-[11px] font-semibold text-gray-800 truncate leading-tight">{{ $kosan->nama_kosan }}</p>
                                    <p class="text-[10px] text-green-700 font-bold mt-0.5">Rp {{ number_format($kosan->harga_per_bulan, 0, ',', '.') }}</p>
                                    <p class="text-[10px] text-gray-400">{{ $kosan->kamar_tersedia }}/{{ $kosan->jumlah_kamar }} kamar</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-400">
                        <p class="text-xs">Belum ada kosan.
                            <a href="{{ route('pemilik.kosan.create') }}" class="text-green-600 font-semibold">Tambah sekarang</a>
                        </p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
