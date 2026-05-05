<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kosan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('pemilik.kosan.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Tambah Kosan
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="border-b py-2 px-4">Foto Utama</th>
                                <th class="border-b py-2 px-4">Nama Kosan</th>
                                <th class="border-b py-2 px-4">Tipe</th>
                                <th class="border-b py-2 px-4">Harga</th>
                                <th class="border-b py-2 px-4">Kamar Tersedia</th>
                                <th class="border-b py-2 px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kosans as $kosan)
                                <tr>
                                    <td class="border-b py-2 px-4">
                                        @if($kosan->fotoUtama)
                                            <img src="{{ asset('storage/' . $kosan->fotoUtama->foto) }}" alt="Foto {{ $kosan->nama_kosan }}" class="w-20 h-20 object-cover rounded">
                                        @else
                                            <span class="text-gray-500">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td class="border-b py-2 px-4">{{ $kosan->nama_kosan }}</td>
                                    <td class="border-b py-2 px-4 capitalize">{{ $kosan->tipe }}</td>
                                    <td class="border-b py-2 px-4">Rp {{ number_format($kosan->harga_per_bulan, 0, ',', '.') }}</td>
                                    <td class="border-b py-2 px-4">{{ $kosan->kamar_tersedia }} / {{ $kosan->jumlah_kamar }}</td>
                                    <td class="border-b py-2 px-4">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('pemilik.kosan.show', $kosan) }}" class="text-blue-500 hover:text-blue-700">Detail</a>
                                            <a href="{{ route('pemilik.kosan.edit', $kosan) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                                            <form action="{{ route('pemilik.kosan.destroy', $kosan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kosan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border-b py-4 px-4 text-center">Belum ada data kosan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
