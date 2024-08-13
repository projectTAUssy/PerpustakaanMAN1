@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mt-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Peminjaman Kelas</h5>
            <a href="{{ route('peminjaman_kelas.create') }}" class="btn btn-success btn-lg">
                <i class="fas fa-plus me-1"></i> Tambah Peminjaman
            </a>
        </div>
        <div class="table-responsive text-nowrap p-3">
        <table class="table table-striped" id="example">
                <thead>
                    <tr class="text-nowrap">
                        <th>Nama Kelas</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Jumlah Buku</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjamanKelas as $peminjaman)
                        <tr>
                            <td>{{ $peminjaman->user->kelas }}</td>
                            <td>{{ $peminjaman->buku->judul }}</td>
                            <td>{{ $peminjaman->tanggal_pinjam }}</td>
                            <td>
                                @if($peminjaman->tanggal_kembali)
                                    {{ $peminjaman->tanggal_kembali }}
                                @else
                                    Belum ditentukan
                                @endif
                            </td>
                            <td>{{ $peminjaman->status }}</td>
                            <td>{{ $peminjaman->jumlah_buku }} Buku</td>
                            <td>
                                @if($peminjaman->status == 'Dipinjam')
                                    @php
                                        $denda = $peminjaman->hitungDenda();
                                    @endphp
                                    @if($denda > 0)
                                        <span class="text-danger font-weight-bold">Rp {{ number_format($denda, 0, ',', '.') }}</span>
                                    @else
                                        -
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('peminjaman_kelas.show', $peminjaman->id) }}" class="btn btn-info btn-sm" title="Detail">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('peminjaman_kelas.edit', $peminjaman->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('peminjaman_kelas.destroy', $peminjaman->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?');">
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
        $('#peminjamanKelasTable').DataTable(); // Pastikan ID tabel sesuai
    });
</script>
@endpush