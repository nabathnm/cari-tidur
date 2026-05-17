---
name: cari-tidur-project
description: >
  Skill ini berisi panduan lengkap untuk bekerja pada project Cari Tidur,
  sebuah platform pencarian kos-kosan berbasis Laravel 12. Gunakan skill ini
  setiap kali diminta untuk membuat fitur baru, memperbaiki bug, atau
  memodifikasi kode di project ini agar konsisten dengan arsitektur,
  konvensi penamaan, dan stack teknologi yang sudah ada.
---

# Cari Tidur — Project Skill

## Deskripsi Project

**Cari Tidur** adalah aplikasi web pencarian dan pemesanan kos-kosan yang dibangun dengan **Laravel 12** + **Blade** + **Tailwind CSS** + **Vite**. Aplikasi memiliki dua role utama: **Pemilik Kos** dan **User (Pencari Kos)**.

---

## Tech Stack

| Layer        | Teknologi                          |
|--------------|------------------------------------|
| Framework    | Laravel 12 (PHP 8.2+)             |
| Auth         | Laravel Breeze (Blade)             |
| Frontend     | Blade Templates + Tailwind CSS     |
| Bundler      | Vite                               |
| Database     | MySQL (`caritidur_db`)             |
| Queue/Cache  | Database driver                    |
| Font         | Poppins (Google Fonts)             |

---

## Struktur Direktori Penting

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/            # Auth controllers (Breeze)
│   │   ├── Pemilik/         # KosanController, PemesananController
│   │   ├── User/            # KosanController, PemesananController
│   │   └── ProfileController.php
│   ├── Middleware/
│   │   └── CheckRole.php    # Middleware role:pemilik / role:user
│   └── Requests/
├── Models/
│   ├── User.php             # role: pemilik | user
│   ├── Kosan.php            # Data kos-kosan
│   ├── FotoKosan.php        # Foto kos (has is_utama flag)
│   ├── Pemesanan.php        # Booking/pemesanan
│   └── Ulasan.php           # Review/rating
├── Providers/
└── View/
resources/views/
├── auth/                    # Login, register, choose role
├── components/              # Reusable Blade components
├── layouts/                 # Layout templates
├── pemilik/                 # Views untuk pemilik kos
├── user/                    # Views untuk pencari kos
├── profile/                 # Profile management views
└── welcome.blade.php        # Landing page
routes/
├── web.php                  # Semua route utama
└── auth.php                 # Route autentikasi (Breeze)
```

---

## Model & Relasi

### User
- `fillable`: name, email, password, role, no_hp, alamat, foto_profil
- `role` bisa bernilai `'pemilik'` atau `'user'`
- Relasi: `kosans()`, `pemesanans()`, `ulasans()`
- Helper: `isPemilik()`, `isUser()`

### Kosan
- `fillable`: user_id, nama_kosan, deskripsi, alamat, kota, harga_per_bulan, jumlah_kamar, kamar_tersedia, tipe, fasilitas, status
- `fasilitas` di-cast sebagai `array` (JSON)
- Relasi: `pemilik()`, `fotos()`, `fotoUtama()`, `pemesanans()`, `ulasans()`
- Helper: `ratingRata()` — average rating dari ulasan

### FotoKosan
- `fillable`: kosan_id, foto, is_utama
- Relasi: `kosan()`

### Pemesanan
- `fillable`: user_id, kosan_id, tanggal_masuk, durasi_bulan, total_harga, status, catatan
- Relasi: `user()`, `kosan()`

### Ulasan
- `fillable`: user_id, kosan_id, rating, komentar
- Relasi: `user()`, `kosan()`

---

## Routing Conventions

### Public Routes (tanpa auth)
- `GET /home` → daftar kosan (UserKosanController@index)
- `GET /kosan` → pencarian kosan (UserKosanController@search)
- `GET /kosan/{kosan}` → detail kosan (UserKosanController@show)

### Pemilik Routes (`/pemilik/*`, middleware: auth + role:pemilik)
- `GET /pemilik/dashboard` → dashboard pemilik
- Resource: `/pemilik/kosan` (CRUD kosan)
- Resource: `/pemilik/pemesanan` (manage pemesanan)
- `PATCH /pemilik/pemesanan/{id}/setujui` → approve pemesanan
- `PATCH /pemilik/pemesanan/{id}/tolak` → reject pemesanan

### User Routes (`/user/*`, middleware: auth + role:user)
- `GET /user/dashboard` → dashboard user (pemesanan saya)
- Resource: `/user/pemesanan` (booking kosan)
- `POST /user/kosan/{kosan}/ulasan` → submit review

---

## Konvensi Kode

### Penamaan
- **Controller**: PascalCase, grouped per-role (`Pemilik\KosanController`, `User\KosanController`)
- **Model**: PascalCase singular Bahasa Indonesia (`Kosan`, `Pemesanan`, `Ulasan`)
- **Migration**: snake_case plural (`create_kosans_table`, `create_pemesanans_table`)
- **Route names**: dot notation dengan prefix role (`pemilik.kosan.index`, `user.pemesanan.store`)
- **Views**: lowercase, grouped per-role (`pemilik/kosan/index.blade.php`, `user/dashboard.blade.php`)
- **Bahasa**: Nama tabel, kolom, dan variabel menggunakan **Bahasa Indonesia**

### Controller Pattern
- Gunakan **Resource Controller** untuk CRUD
- Pisahkan controller berdasarkan role (`Pemilik\`, `User\`)
- Import controller dengan alias jika nama sama:
  ```php
  use App\Http\Controllers\Pemilik\KosanController as PemilikKosanController;
  use App\Http\Controllers\User\KosanController as UserKosanController;
  ```

### Middleware
- Role checking menggunakan `CheckRole` middleware dengan parameter: `role:pemilik` atau `role:user`
- Route group pattern:
  ```php
  Route::middleware(['auth', 'role:pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
      // ...
  });
  ```

### Frontend / Blade
- Gunakan **Tailwind CSS** untuk styling
- Gunakan **Blade Components** untuk komponen reusable (folder `resources/views/components/`)
- Layout tersedia di `resources/views/layouts/`
- Font utama: **Poppins** (Google Fonts)

---

## Panduan Saat Membuat Fitur Baru

1. **Model**: Buat model di `app/Models/` dengan nama PascalCase Bahasa Indonesia
2. **Migration**: Buat migration dengan kolom yang sesuai, gunakan nama tabel plural
3. **Controller**: Tempatkan di subfolder sesuai role (`Pemilik/` atau `User/`)
4. **Routes**: Tambahkan di `routes/web.php` dalam group middleware yang sesuai
5. **Views**: Buat di `resources/views/{role}/` menggunakan layout yang sudah ada
6. **Validasi**: Gunakan Form Request di `app/Http/Requests/` jika validasi kompleks

---

## Perintah Development

```bash
# Jalankan server development (Laravel + Vite + Queue + Logs)
composer dev

# Setup project pertama kali
composer setup

# Jalankan test
composer test

# Jalankan migration
php artisan migrate

# Buat controller baru
php artisan make:controller Pemilik/NamaController --resource

# Buat model + migration
php artisan make:model NamaModel -m
```

---

## Catatan Penting

- Selalu pastikan `kamar_tersedia` pada model `Kosan` diupdate saat ada pemesanan baru yang disetujui
- Field `fasilitas` di `Kosan` disimpan sebagai JSON array
- Foto kosan disimpan di storage, dengan flag `is_utama` untuk foto utama
- Status pemesanan memiliki flow: pending → disetujui/ditolak
- Gunakan Bahasa Indonesia untuk penamaan yang konsisten dengan codebase yang ada
