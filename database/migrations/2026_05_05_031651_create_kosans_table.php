<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_kosans_table.php
public function up()
{
    Schema::create('kosans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // pemilik
        $table->string('nama_kosan');
        $table->text('deskripsi');
        $table->string('alamat');
        $table->string('kota');
        $table->decimal('harga_per_bulan', 10, 2);
        $table->integer('jumlah_kamar');
        $table->integer('kamar_tersedia');
        $table->enum('tipe', ['putra', 'putri', 'campur']);
        $table->json('fasilitas')->nullable(); // ['wifi', 'ac', 'parkir']
        $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosans');
    }
};
