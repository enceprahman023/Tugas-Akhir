<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Berita Acara - DUCARE</title>
    <style>
        @page { margin: 40px 50px 60px 50px; }
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 11pt; color: #333; line-height: 1.5; }
        
        /* Header / Kop Surat */
        .kop-surat { width: 100%; border-bottom: 3px solid #000; padding-bottom: 15px; margin-bottom: 25px; }
        .kop-surat table { width: 100%; border-collapse: collapse; }
        .kop-logo { width: 15%; text-align: left; vertical-align: middle; }
        .kop-logo img { width: 80px; }
        .kop-teks { width: 85%; text-align: center; vertical-align: middle; }
        .kop-teks h1 { margin: 0; font-size: 16pt; font-weight: bold; letter-spacing: 1px; color: #1e293b; }
        .kop-teks h2 { margin: 5px 0 0; font-size: 12pt; font-weight: normal; color: #475569; }
        .kop-teks p { margin: 5px 0 0; font-size: 9pt; color: #64748b; }

        /* Judul Dokumen */
        .judul-dokumen { text-align: center; margin-bottom: 20px; }
        .judul-dokumen h3 { margin: 0; font-size: 14pt; text-decoration: underline; font-weight: bold; }
        .judul-dokumen p { margin: 5px 0 0; font-size: 10pt; }

        /* Tabel Data */
        .tabel-data { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .tabel-data th, .tabel-data td { border: 1px solid #cbd5e1; padding: 8px 12px; text-align: left; vertical-align: top; font-size: 11pt; }
        .tabel-data th { width: 30%; background-color: #f8fafc; font-weight: bold; color: #334155; }
        .tabel-data td { width: 70%; color: #1e293b; }

        /* Bukti Foto */
        .bukti-foto { text-align: center; margin-bottom: 20px; }
        .bukti-foto img { max-width: 300px; max-height: 200px; border: 1px solid #ccc; padding: 5px; border-radius: 5px; }
        .bukti-foto p { margin-top: 10px; font-size: 10pt; font-style: italic; color: #64748b; }

        /* Tanda Tangan */
        .ttd-container { width: 100%; margin-top: 40px; page-break-inside: avoid; }
        .ttd-box { float: right; width: 40%; text-align: center; }
        .ttd-box p { margin: 0 0 5px 0; font-size: 11pt; }
        .ttd-image { height: 80px; margin: 10px 0; object-fit: contain; }
        .ttd-nama { font-weight: bold; text-decoration: underline; }

        /* Clearfix */
        .clearfix::after { content: ""; clear: both; display: table; }

        /* Footer Halaman */
        footer {
            position: fixed;
            bottom: -40px;
            left: 0;
            right: 0;
            height: 30px;
            text-align: center;
            font-size: 9pt;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            padding-top: 5px;
        }
        footer .page-number:after {
            content: "Halaman " counter(page);
        }
    </style>
</head>
<body>
    <footer>
        <span class="page-number"></span>
    </footer>

@php
    $logoPath = null;
    if (file_exists(public_path('images/logodu.png'))) {
        $logoPath = public_path('images/logodu.png');
    }
    
    // Path untuk bukti dan TTD
    $buktiPath = null;
    if ($laporan->bukti_gambar && file_exists(storage_path('app/public/' . $laporan->bukti_gambar))) {
        $buktiPath = storage_path('app/public/' . $laporan->bukti_gambar);
    }

    $ttdPath = null;
    if ($laporan->ttd_penangan && file_exists(storage_path('app/public/' . $laporan->ttd_penangan))) {
        $ttdPath = storage_path('app/public/' . $laporan->ttd_penangan);
    }

    // Nama penanggung jawab (fallback)
    $namaPenanggungJawab = !empty($laporan->ditangani_oleh) ? $laporan->ditangani_oleh : (auth()->check() ? auth()->user()->name : 'Guru BK / Penanggung Jawab');
@endphp

    <!-- Kop Surat -->
    <div class="kop-surat">
        <table>
            <tr>
                <td class="kop-logo">
                    @if($logoPath)
                        <img src="{{ $logoPath }}" alt="Logo">
                    @endif
                </td>
                <td class="kop-teks">
                    <h1>SISTEM PENGADUAN BULLYING</h1>
                    <h2>DUCARE (Ducare Anti-Bullying Care)</h2>
                    <p>Layanan Perlindungan dan Penanganan Kasus Bullying di Lingkungan Sekolah</p>
                </td>
            </tr>
        </table>
    </div>

    <!-- Judul Dokumen -->
    <div class="judul-dokumen">
        <h3>BERITA ACARA LAPORAN</h3>
        <p>Nomor Registrasi: <strong>LAP-{{ str_pad($laporan->id, 4, '0', STR_PAD_LEFT) }}</strong></p>
    </div>

    <!-- Data Tabel -->
    <table class="tabel-data">
        <tr>
            <th>Waktu Laporan</th>
            <td>{{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y - H:i') }} WIB</td>
        </tr>
        <tr>
            <th>Status Penanganan</th>
            <td><strong>{{ strtoupper($laporan->status ?? 'Belum Ditangani') }}</strong></td>
        </tr>
        <tr>
            <th>Nama Pelapor</th>
            <td>{{ $laporan->nama_pelapor === 'Anonim' ? 'Dirahasiakan (Anonim)' : $laporan->nama_pelapor }}</td>
        </tr>
        <tr>
            <th>Tanggal Kejadian</th>
            <td>{{ \Carbon\Carbon::parse($laporan->tanggal_kejadian)->format('d M Y') }}</td>
        </tr>
        <tr>
            <th>Pelaku (Terlapor)</th>
            <td><strong>{{ $laporan->nama_pembully }}</strong></td>
        </tr>
        <tr>
            <th>Saksi Kejadian</th>
            <td>{{ $laporan->nama_saksi ?? '-' }}</td>
        </tr>
        <tr>
            <th>Kategori Laporan</th>
            <td>{{ $laporan->judul_laporan }}</td>
        </tr>
        <tr>
            <th>Uraian Kejadian</th>
            <td style="text-align: justify;">{{ $laporan->isi_laporan }}</td>
        </tr>
        <tr>
            <th>Hasil Investigasi / Penanganan</th>
            <td style="text-align: justify; background-color: #f8fafc;">
                <em>{{ $laporan->catatan_penanganan ?? 'Belum ada catatan atau tindak lanjut dari pihak penanggung jawab.' }}</em>
            </td>
        </tr>
    </table>

    <!-- Bukti Gambar -->
    @if($buktiPath)
    <div class="bukti-foto">
        <p style="font-weight: bold; margin-bottom: 5px; text-align: left;">Lampiran Bukti Kejadian:</p>
        <img src="{{ $buktiPath }}" alt="Bukti Kejadian">
    </div>
    @endif

    <!-- Tanda Tangan -->
    <div class="ttd-container clearfix">
        <div class="ttd-box">
            <p>Disahkan pada: {{ $laporan->tanggal_penanganan ? \Carbon\Carbon::parse($laporan->tanggal_penanganan)->format('d M Y') : \Carbon\Carbon::now()->format('d M Y') }}</p>
            <p>Penanggung Jawab,</p>
            
            @if($ttdPath)
                <img src="{{ $ttdPath }}" class="ttd-image" alt="Tanda Tangan">
            @else
                <div style="height: 80px; width: 100%;"></div>
            @endif

            <p class="ttd-nama">{{ $namaPenanggungJawab }}</p>
        </div>
    </div>

</body>
</html>
