<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Laporan DUCARE</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            color: #374151;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }
        .header {
            background-color: {{ $laporan->status === 'Selesai' ? '#16a34a' : '#dc2626' }};
            padding: 25px 30px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            padding: 30px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .info-box {
            background-color: {{ $laporan->status === 'Selesai' ? '#f0fdf4' : '#fef2f2' }};
            border-left: 4px solid {{ $laporan->status === 'Selesai' ? '#22c55e' : '#ef4444' }};
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 25px;
        }
        .info-row {
            margin-bottom: 12px;
            display: flex;
        }
        .info-label {
            font-weight: bold;
            color: {{ $laporan->status === 'Selesai' ? '#14532d' : '#7f1d1d' }};
            width: 150px;
            flex-shrink: 0;
        }
        .info-value {
            color: #111827;
            font-weight: 500;
        }
        .catatan-box {
            background-color: #f9fafb;
            border: 1px dashed #d1d5db;
            padding: 15px;
            border-radius: 6px;
            margin-top: 10px;
            font-style: italic;
            color: #4b5563;
        }
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }
        .btn {
            display: inline-block;
            background-color: #1d4ed8;
            color: #ffffff;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(29, 78, 216, 0.2);
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>

<div class="email-container">
    <div class="header">
        <h1>
            {{ $laporan->status === 'Selesai' ? '✅ Laporan Selesai Ditangani' : '❌ Laporan Ditolak' }}
        </h1>
    </div>
    
    <div class="content">
        <p>Halo <strong>{{ $laporan->nama_pelapor ?? ($laporan->pelapor->name ?? 'Pengguna') }}</strong>,</p>
        <p>Kami ingin menginformasikan bahwa laporan yang Anda kirimkan melalui portal <strong>DUCARE</strong> telah diperiksa dan diperbarui statusnya oleh Guru BK.</p>

        <div class="info-box">
            <div class="info-row">
                <div class="info-label">No. Registrasi:</div>
                <div class="info-value">LAP-{{ str_pad($laporan->id, 4, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Judul Kasus:</div>
                <div class="info-value">{{ $laporan->judul_laporan }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Status Akhir:</div>
                <div class="info-value">
                    <strong style="color: {{ $laporan->status === 'Selesai' ? '#16a34a' : '#dc2626' }}; text-uppercase">
                        {{ $laporan->status }}
                    </strong>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Ditangani Oleh:</div>
                <div class="info-value">{{ $laporan->ditangani_oleh ?? 'Guru BK' }}</div>
            </div>
            @if($laporan->tanggal_penanganan)
            <div class="info-row">
                <div class="info-label">Tanggal Selesai:</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($laporan->tanggal_penanganan)->format('d F Y') }}</div>
            </div>
            @endif
            
            @if($laporan->catatan_penanganan)
            <div style="margin-top: 15px;">
                <div class="info-label" style="width: auto; margin-bottom: 5px;">Catatan Penanganan/Tindak Lanjut:</div>
                <div class="catatan-box">
                    "{!! nl2br(e($laporan->catatan_penanganan)) !!}"
                </div>
            </div>
            @endif
        </div>

        <p>Terima kasih atas partisipasi dan kepedulian Anda dalam menjaga kenyamanan dan keamanan lingkungan kita bersama.</p>

        <div class="btn-container">
            <a href="{{ route('login') }}" class="btn">Buka Portal DUCARE</a>
        </div>
    </div>

    <div class="footer">
        <p>Email ini dikirim secara otomatis oleh Sistem DUCARE.<br>Mohon tidak membalas email ini.</p>
    </div>
</div>

</body>
</html>
