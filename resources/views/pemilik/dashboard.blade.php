<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pemilik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat datang, Pemilik Kosan!") }}
                    <div class="mt-4">
                        <p class="text-lg">Total Kosan Anda: <span class="font-bold">{{ $totalKosan ?? 0 }}</span></p>
                        <a href="{{ route('pemilik.kosan.index') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Kelola Kosan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
