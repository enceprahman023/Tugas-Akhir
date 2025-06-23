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
       Schema::create('laporans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pelapor_id')->nullable()->constrained('pelapor')->onDelete('cascade');
    $table->enum('jenis_pelaporan', ['anonim', 'non-anonim']); // <- Pilihan dari frontend
    $table->string('nama_pelapor')->nullable();                // <- Wajib jika non-anonim, bisa 'Anonim' kalau anonim
    $table->date('tanggal_kejadian');
    $table->string('nama_pembully');
    $table->string('judul_laporan');
    $table->text('isi_laporan');
    $table->string('nama_saksi')->nullable();
    $table->string('bukti_gambar')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
