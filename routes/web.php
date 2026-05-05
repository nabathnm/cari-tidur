<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pemilik\KosanController as PemilikKosanController;
use App\Http\Controllers\Pemilik\PemesananController as PemilikPemesananController;
use App\Http\Controllers\Pencari\KosanController as PencariKosanController;
use App\Http\Controllers\Pencari\PemesananController as PencariPemesananController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Public
Route::get('/', [PencariKosanController::class, 'index'])->name('home');
Route::get('/kosan/{kosan}', [PencariKosanController::class, 'show'])->name('kosan.show');
Route::get('/kosan', [PencariKosanController::class, 'search'])->name('kosan.search');

// Pemilik Kosan
Route::middleware(['auth', 'role:pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/dashboard', [PemilikKosanController::class, 'dashboard'])->name('dashboard');
    Route::resource('kosan', PemilikKosanController::class);
    Route::resource('pemesanan', PemilikPemesananController::class);
    Route::patch('pemesanan/{pemesanan}/setujui', [PemilikPemesananController::class, 'setujui'])->name('pemesanan.setujui');
    Route::patch('pemesanan/{pemesanan}/tolak', [PemilikPemesananController::class, 'tolak'])->name('pemesanan.tolak');
});

// Pencari Kosan
Route::middleware(['auth', 'role:pencari'])->prefix('pencari')->name('pencari.')->group(function () {
    Route::get('/dashboard', [PencariPemesananController::class, 'dashboard'])->name('dashboard');
    Route::resource('pemesanan', PencariPemesananController::class);
    Route::post('/kosan/{kosan}/ulasan', [PencariKosanController::class, 'ulasan'])->name('kosan.ulasan');
});

require __DIR__.'/auth.php';
