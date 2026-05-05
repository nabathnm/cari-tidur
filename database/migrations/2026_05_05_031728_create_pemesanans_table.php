<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('pemesanans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade'); // user
    $table->foreignId('kosan_id')->constrained()->onDelete('cascade');
    $table->date('tanggal_masuk');
    $table->integer('durasi_bulan');
    $table->decimal('total_harga', 10, 2);
    $table->enum('status', ['pending', 'disetujui', 'ditolak', 'selesai'])->default('pending');
    $table->text('catatan')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
