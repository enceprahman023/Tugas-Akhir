<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan LAP-{{ str_pad($laporan->id, 3, '0', STR_PAD_LEFT) }}</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        h3 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { padding: 8px; border: 1px solid #ccc; text-align: left; vertical-align: top; }
        .ttd { text-align: right; margin-top: 50px; }
        .ttd img { height: 80px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <h3>Laporan Kasus Bullying<br>Nomor: LAP-{{ str_pad($laporan->id, 3, '0', STR_PAD_LEFT) }}</h3>

    <table>
        <tr><th>Judul</th><td>{{ $laporan->judul_laporan }}</td></tr>
        <tr><th>Tanggal</th><td>{{ $laporan->created_at->format('Y-m-d') }}</td></tr>
        <tr><th>Status</th><td>{{ $laporan->status }}</td></tr>
        <tr><th>Jenis Pelaporan</th><td>{{ $laporan->jenis_pelaporan }}</td></tr>
        <tr><th>Pelapor</th><td>{{ $laporan->nama_pelapor ?? '-' }}</td></tr>
        <tr><th>Pelaku</th><td>{{ $laporan->nama_pembully }}</td></tr>
        <tr><th>Saksi</th><td>{{ $laporan->nama_saksi ?? '-' }}</td></tr>
        <tr><th>Isi Laporan</th><td>{{ $laporan->isi_laporan }}</td></tr>
        @if ($laporan->bukti_gambar)
        <tr>
            <th>Bukti Foto</th>
            <td><img src="{{ public_path('storage/' . $laporan->bukti_gambar) }}" style="max-height:200px;"></td>
        </tr>
        @endif
    </table>

    <div class="ttd">
        <p>Bandung, {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
        <p>Guru BK</p>
        @if ($laporan->ttd_penangan)
            <img src="{{ public_path('storage/' . $laporan->ttd_penangan) }}"><br>
        @endif
        <strong>{{ $laporan->ditangani_oleh ?? 'Admin' }}</strong>
    </div>

</body>
</html>
