<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Guru extends Authenticatable

{
    use HasFactory, Notifiable;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel (misal: 'guru_bk' bukan 'gurus')
    // protected $table = 'guru_bk'; // Tidak perlu jika nama tabel kamu 'gurus'

    protected $fillable = [
        'name',
        'nip',
        'email',
        'phone_number',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
