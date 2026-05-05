<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pemilik\KosanController as PemilikKosanController;
use App\Http\Controllers\Pemilik\PemesananController as PemilikPemesananController;
use App\Http\Controllers\User\KosanController as UserKosanController;
use App\Http\Controllers\User\PemesananController as UserPemesananController;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('home') : view('auth.choose');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Public
Route::get('/', [UserKosanController::class, 'index'])->name('home');
Route::get('/kosan/{kosan}', [UserKosanController::class, 'show'])->name('kosan.show');
Route::get('/kosan', [UserKosanController::class, 'search'])->name('kosan.search');

// Pemilik Kosan
Route::middleware(['auth', 'role:pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/dashboard', [PemilikKosanController::class, 'dashboard'])->name('dashboard');
    Route::resource('kosan', PemilikKosanController::class);
    Route::resource('pemesanan', PemilikPemesananController::class);
    Route::patch('pemesanan/{pemesanan}/setujui', [PemilikPemesananController::class, 'setujui'])->name('pemesanan.setujui');
    Route::patch('pemesanan/{pemesanan}/tolak', [PemilikPemesananController::class, 'tolak'])->name('pemesanan.tolak');
});

// User Kosan
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserPemesananController::class, 'dashboard'])->name('dashboard');
    Route::resource('pemesanan', UserPemesananController::class);
    Route::post('/kosan/{kosan}/ulasan', [UserKosanController::class, 'ulasan'])->name('kosan.ulasan');
});

require __DIR__.'/auth.php';
