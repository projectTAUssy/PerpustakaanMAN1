@extends('layouts.main')

@section('content')
<style>
    .btn-custom {
        background-color: #009621;
        color: white;
        border: none;
    }
    .btn-large {
        font-size: 0.5 rem; /* Ukuran teks lebih besar */
        padding: 0.75rem 1.25rem; /* Padding lebih besar */
    }
    .btn-custom:hover {
        background-color: #007a19; /* Warna saat hover */
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mt-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Semua Peminjaman</h5>
            <div>
            <a href="{{ route('peminjaman.exportPdf') }}" class="btn btn-custom btn-large">
    <i class="fas fa-file-pdf me-1"></i> Ekspor PDF
</a>

                <!-- 
                Uncomment these buttons if needed
                <a href="{{ route('peminjaman.create') }}" class="btn btn-success btn-lg">
                    <i class="fas fa-plus me-1"></i> Tambah Peminjaman
                </a>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-book-open me-1"></i> Lihat Dipinjam
                </a>
                <a href="{{ route('peminjaman.returned') }}" class="btn btn-info btn-lg">
                    <i class="fas fa-undo me-1"></i> Lihat Dikembalikan
                </a>
                -->
            </div>
        </div>
        <div class="table-responsive text-nowrap p-3">
        <table class="table table-striped" id="example">
                <thead>
                    <tr class="text-nowrap">
                        <th>Nama Pengguna</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status</th>
                        <th>Jumlah Buku</th>
                        <th>Denda</th> <!-- Kolom Denda Ditambahkan -->
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($semuaPeminjamans as $peminjaman)
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
                                @if($peminjaman->denda > 0)
                                    <span class="text-danger fw-bold">Rp. {{ number_format($peminjaman->denda, 0, ',', '.') }}</span>
                                @else
                                    Rp. {{ number_format($peminjaman->denda, 0, ',', '.') }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('peminjaman.show', $peminjaman->id) }}" class="btn btn-info btn-sm" title="Detail">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Uncomment if needed
                                @if($peminjaman->status != 'Dikembalikan')
                                    <form action="{{ route('peminjaman.updateStatus', $peminjaman->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm" title="Dikembalikan">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif
                                -->
                                <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#peminjamanTable').DataTable(); // Pastikan ID tabel sesuai
    });
</script>
@endpush
