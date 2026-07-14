<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Baru Masuk</title>
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
            background-color: #dc2626; /* Merah untuk Urgensi */
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
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
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
            color: #7f1d1d;
            width: 140px;
            flex-shrink: 0;
        }
        .info-value {
            color: #111827;
            font-weight: 500;
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
        <h1>🚨 Laporan Bullying Baru!</h1>
    </div>
    
    <div class="content">
        <p>Halo Bapak/Ibu Guru BK dan Admin,</p>
        <p>Sistem <strong>DUCARE</strong> baru saja menerima laporan kasus perundungan (bullying) baru yang membutuhkan perhatian dan penanganan segera. Berikut adalah rincian singkat laporan tersebut:</p>

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
                <div class="info-label">Tanggal Kejadian:</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($laporan->tanggal_kejadian)->format('d F Y') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Terduga Pelaku:</div>
                <div class="info-value">{{ $laporan->nama_pembully }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Waktu Masuk:</div>
                <div class="info-value">{{ $laporan->created_at->format('d/m/Y H:i:s') }} WIB</div>
            </div>
        </div>

        <p>Mohon segera masuk ke sistem untuk melihat bukti kejadian, mengetahui saksi mata, dan melakukan tindak lanjut penanganan kasus ini agar korban segera mendapatkan perlindungan.</p>

        <div class="btn-container">
            <a href="{{ route('guru.login') }}" class="btn">Buka Sistem DUCARE</a>
        </div>
    </div>

    <div class="footer">
        <p>Email ini dikirim secara otomatis oleh Sistem DUCARE.<br>Mohon tidak membalas email ini.</p>
    </div>
</div>

</body>
</html>
