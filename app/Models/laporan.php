<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Tentukan kolom-kolom yang boleh diisi secara massal (mass assignable)
  protected $fillable = [
    'jenis_pelaporan',
    'nama_pelapor',
    'tanggal_kejadian',
    'nama_pembully',
    'judul_laporan',
    'isi_laporan',
    'nama_saksi',
    'bukti_gambar',
    'status',
    'catatan_penanganan',
    'tanggal_penanganan',
];
    /**
     * Definisikan relasi laporan ini dimiliki oleh satu pelapor.
     */
    public function pelapor()
    {
        return $this->belongsTo(Pelapor::class); // <-- Pastikan nama model Pelapor Anda benar (User.php atau Pelapor.php)
    }
}
