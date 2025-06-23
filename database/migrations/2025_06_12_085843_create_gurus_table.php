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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // Untuk 'Nama lengkap'
            $table->string('nip')->unique();    // Untuk 'NIP', harus unik
            $table->string('email')->unique();  // Untuk 'Email aktif', harus unik
            $table->string('phone_number')->nullable(); // Untuk 'Nomor kontak', bisa kosong
            $table->timestamp('email_verified_at')->nullable(); // Opsional: untuk verifikasi email
            $table->string('password');         // Untuk 'Kata sandi' (akan disimpan dalam bentuk hash)
            $table->rememberToken()->nullable(); // Untuk fitur "Remember Me"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
