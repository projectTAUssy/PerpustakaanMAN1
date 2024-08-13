<!DOCTYPE html>
<html>
<head>
    <title>Daftar Semua Peminjaman</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .container { width: 100%; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1, .header h2 { margin: 0; }
        .header h1 { font-size: 24px; }
        .header h2 { font-size: 18px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f4f4f4; }
        .text-danger { color: red; font-weight: bold; }
        .summary { margin-top: 20px; }
        .summary table { width: auto; border: none; margin-bottom: 0; }
        .summary th, .summary td { border: none; text-align: left; padding: 4px 8px; }
        .footer { text-align: right; font-size: 12px; color: #666; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>MAN 1 Dumai</h1>
            <h2>Jl. Bukit Datuk Lama, Bukit Datuk, Kec. Dumai Bar., Kota Dumai, Riau 28826</h2>
            <h2>Daftar Semua Peminjaman</h2>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                    <th>Jumlah Buku</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalBukuDipinjam = 0;
                    $totalBukuDikembalikan = 0;
                    $totalDenda = 0;
                @endphp
                @foreach($semuaPeminjamans as $peminjaman)
                    @php
                        $jumlahBuku = $peminjaman->details->sum('jumlah');
                        $totalBukuDipinjam += $jumlahBuku;
                        if ($peminjaman->status == 'Dikembalikan') {
                            $totalBukuDikembalikan += $jumlahBuku;
                        }
                        $totalDenda += $peminjaman->denda;
                    @endphp
                    <tr>
                        <td>{{ $peminjaman->user->name }}</td>
                        <td>{{ $peminjaman->created_at->format('d-m-Y H:i:s') }}</td>
                        <td>
                            @if($peminjaman->tanggal_pengembalian)
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian)->format('d-m-Y') }}
                            @else
                                Belum ditentukan
                            @endif
                        </td>
                        <td>{{ $peminjaman->status }}</td>
                        <td>{{ $jumlahBuku }} Buku</td>
                        <td>
                            @if($peminjaman->denda > 0)
                                <span class="text-danger">Rp. {{ number_format($peminjaman->denda, 0, ',', '.') }}</span>
                            @else
                                Rp. {{ number_format($peminjaman->denda, 0, ',', '.') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <h3>Keterangan</h3>
            <table>
                <tr>
                    <th>Total Buku Dipinjam:</th>
                    <td>{{ $totalBukuDipinjam }} Buku</td>
                </tr>
                <tr>
                    <th>Total Buku Dikembalikan:</th>
                    <td>{{ $totalBukuDikembalikan }} Buku</td>
                </tr>
                <tr>
                    <th>Total Denda:</th>
                    <td>Rp. {{ number_format($totalDenda, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}
        </div>
    </div>
</body>
</html>
