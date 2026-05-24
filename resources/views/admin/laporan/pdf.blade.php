<!DOCTYPE html>
<html>
<head>
    <title>Laporan Reservasi Warkop Pamulang</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #8B7355;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #8B7355;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .info {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #eee;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #8B7355;
        }
        .text-right {
            text-align: right;
        }
        .total-section {
            float: right;
            width: 300px;
            margin-top: 20px;
        }
        .total-row {
            padding: 10px;
            background-color: #8B7355;
            color: white;
            font-weight: bold;
            border-radius: 5px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #999;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Warkop Pamulang</h1>
        <p>Laporan Reservasi - Periode: {{ $bulan == 'all' ? 'Semua Bulan' : Carbon\Carbon::create()->month((int)$bulan)->translatedFormat('F') }} {{ $tahun }}</p>
    </div>

    <div class="info">
        <p>Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Meja</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th class="text-right">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $index => $res)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $res->user->name }}</td>
                <td>{{ $res->meja->nama_meja }}</td>
                <td>{{ $res->tanggal->format('d/m/Y') }}</td>
                <td>{{ ucfirst($res->status) }}</td>
                <td class="text-right">Rp {{ number_format($res->pembayaran ? $res->pembayaran->total_bayar : 0, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-row">
            <span style="float: left;">TOTAL PENDAPATAN:</span>
            <span style="float: right;">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</span>
            <div style="clear: both;"></div>
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Warkop Pamulang - Sistem Reservasi Online
    </div>
</body>
</html>
