<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Hapus admin lama (opsional, untuk update password)
        User::where('email', 'admin@ducare.com')->delete();

        // Tambah admin baru
        User::create([
            'name' => 'Admin DUCARE',
            'email' => 'admin@ducare.com',
            'password' => bcrypt('admin123'), // Ubah ini kalau mau ganti password
            'role' => 'admin',
        ]);
    }
}
