<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kosan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('pemilik.kosan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nama_kosan" class="block text-gray-700 font-bold mb-2">Nama Kosan:</label>
                            <input type="text" name="nama_kosan" id="nama_kosan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nama_kosan') }}" required>
                            @error('nama_kosan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi:</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="block text-gray-700 font-bold mb-2">Alamat:</label>
                            <input type="text" name="alamat" id="alamat" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('alamat') }}" required>
                            @error('alamat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="kota" class="block text-gray-700 font-bold mb-2">Kota:</label>
                            <input type="text" name="kota" id="kota" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('kota') }}" required>
                            @error('kota') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="harga_per_bulan" class="block text-gray-700 font-bold mb-2">Harga per Bulan (Rp):</label>
                                <input type="number" name="harga_per_bulan" id="harga_per_bulan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('harga_per_bulan') }}" required>
                                @error('harga_per_bulan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="tipe" class="block text-gray-700 font-bold mb-2">Tipe Kosan:</label>
                                <select name="tipe" id="tipe" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="putra" {{ old('tipe') == 'putra' ? 'selected' : '' }}>Putra</option>
                                    <option value="putri" {{ old('tipe') == 'putri' ? 'selected' : '' }}>Putri</option>
                                    <option value="campur" {{ old('tipe') == 'campur' ? 'selected' : '' }}>Campur</option>
                                </select>
                                @error('tipe') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="jumlah_kamar" class="block text-gray-700 font-bold mb-2">Jumlah Total Kamar:</label>
                                <input type="number" name="jumlah_kamar" id="jumlah_kamar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('jumlah_kamar') }}" required>
                                @error('jumlah_kamar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="kamar_tersedia" class="block text-gray-700 font-bold mb-2">Kamar Tersedia:</label>
                                <input type="number" name="kamar_tersedia" id="kamar_tersedia" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('kamar_tersedia') }}" required>
                                @error('kamar_tersedia') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Fasilitas:</label>
                            <div class="flex flex-wrap gap-4">
                                @php $fasilitasList = ['WiFi', 'AC', 'Kamar Mandi Dalam', 'Kasur', 'Lemari', 'Meja', 'Dapur Umum', 'Parkir Motor', 'Parkir Mobil']; @endphp
                                @foreach($fasilitasList as $fasilitas)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="fasilitas[]" value="{{ $fasilitas }}" class="form-checkbox" {{ is_array(old('fasilitas')) && in_array($fasilitas, old('fasilitas')) ? 'checked' : '' }}>
                                        <span class="ml-2">{{ $fasilitas }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="fotos" class="block text-gray-700 font-bold mb-2">Foto Kosan (Bisa upload banyak):</label>
                            <input type="file" name="fotos[]" id="fotos" multiple accept="image/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <p class="text-sm text-gray-500 mt-1">Foto pertama akan menjadi foto utama.</p>
                            @error('fotos.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Simpan Kosan
                            </button>
                            <a href="{{ route('pemilik.kosan.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
