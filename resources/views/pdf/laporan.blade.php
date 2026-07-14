<!DOCTYPE html>
<html>
<head>
    <title>Laporan DUCARE</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .title { font-size: 18px; font-weight: bold; margin-bottom: 5px; }
        .subtitle { font-size: 14px; margin-bottom: 20px; color: #555; }
    </style>
</head>
<body>
    <div class="text-center">
        <div class="title">Data Laporan Bullying DUCARE</div>
        <div class="subtitle">Darul Ulum Care</div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Kejadian</th>
                <th>Pelapor</th>
                <th>Terlapor</th>
                <th>Judul Laporan</th>
                <th>Status</th>
                <th>Guru BK</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporans as $index => $lap)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($lap->tanggal_kejadian)->format('d M Y') }}</td>
                <td>{{ $lap->nama_pelapor }}</td>
                <td>{{ $lap->nama_pembully }}</td>
                <td>{{ $lap->judul_laporan }}</td>
                <td>{{ $lap->status }}</td>
                <td>{{ $lap->ditangani_oleh ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
