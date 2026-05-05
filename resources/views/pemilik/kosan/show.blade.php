<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Kosan: ') . $kosan->nama_kosan }}
            </h2>
            <a href="{{ route('pemilik.kosan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-bold mb-2">Informasi Kosan</h3>
                            <table class="w-full text-left">
                                <tr>
                                    <th class="py-2 pr-4 w-1/3">Nama Kosan</th>
                                    <td class="py-2">{{ $kosan->nama_kosan }}</td>
                                </tr>
                                <tr>
                                    <th class="py-2 pr-4">Tipe</th>
                                    <td class="py-2 capitalize">{{ $kosan->tipe }}</td>
                                </tr>
                                <tr>
                                    <th class="py-2 pr-4">Harga per Bulan</th>
                                    <td class="py-2">Rp {{ number_format($kosan->harga_per_bulan, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th class="py-2 pr-4">Alamat</th>
                                    <td class="py-2">{{ $kosan->alamat }}, {{ $kosan->kota }}</td>
                                </tr>
                                <tr>
                                    <th class="py-2 pr-4">Ketersediaan Kamar</th>
                                    <td class="py-2">{{ $kosan->kamar_tersedia }} / {{ $kosan->jumlah_kamar }}</td>
                                </tr>
                                <tr>
                                    <th class="py-2 pr-4 align-top">Fasilitas</th>
                                    <td class="py-2">
                                        @php
                                            $fasilitas = is_array($kosan->fasilitas) ? $kosan->fasilitas : json_decode($kosan->fasilitas, true) ?? [];
                                        @endphp
                                        @if(count($fasilitas) > 0)
                                            <ul class="list-disc list-inside">
                                                @foreach($fasilitas as $f)
                                                    <li>{{ $f }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            Tidak ada fasilitas spesifik yang didata.
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="py-2 pr-4 align-top">Deskripsi</th>
                                    <td class="py-2 whitespace-pre-line">{{ $kosan->deskripsi }}</td>
                                </tr>
                            </table>
                            <div class="mt-4">
                                <a href="{{ route('pemilik.kosan.edit', $kosan) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    Edit Kosan
                                </a>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold mb-2">Foto Kosan</h3>
                            <div class="grid grid-cols-2 gap-4">
                                @forelse($kosan->fotos as $foto)
                                    <div>
                                        <img src="{{ asset('storage/' . $foto->foto) }}" alt="Foto Kosan" class="w-full h-48 object-cover rounded shadow {{ $foto->is_utama ? 'border-4 border-blue-500' : '' }}">
                                        @if($foto->is_utama)
                                            <p class="text-sm text-center text-blue-500 mt-1 font-bold">Foto Utama</p>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-gray-500 col-span-2">Belum ada foto yang diupload.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
