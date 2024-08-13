@extends('layouts.master')

@section('title', 'Daftar Pengembalian Buku')

@section('content')
    <h3 class="mb-3">Daftar Pengembalian Saya</h3>
    <table id="peminjamanTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nama Pengguna</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
                <th>Jumlah Buku</th>
                <th>Detail Buku</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $peminjaman)
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
                    <td>{{ $peminjaman->details->sum('jumlah') }} Buku</td>
                    <td>
                        <ul>
                            @foreach($peminjaman->details as $detail)
                                <li>
                                    <strong>Judul:</strong> {{ $detail->buku->judul }}<br>
                                    <strong>Pengarang:</strong> {{ $detail->buku->pengarang }}<br>
                                    <strong>Jenis Buku:</strong> {{ $detail->buku->jenis_buku }}<br>
                                    <strong>Tahun Terbit:</strong> {{ $detail->buku->tahun_terbit }}<br>
                                    <strong>Jumlah:</strong> {{ $detail->jumlah }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#peminjamanTable').DataTable({
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    },
                },
                order: [[1, 'desc']]
            });
        });
    </script>
@endpush
