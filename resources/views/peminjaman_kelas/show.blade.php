@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mt-2">
        <div class="card-header">
            <h5 class="mb-0">Detail Peminjaman Kelas</h5>
        </div>
        <div class="card-body">
            <p><strong>Nama Kelas:</strong> {{ $peminjamanKelas->user->kelas }}</p>
            <p><strong>Judul Buku:</strong> {{ $peminjamanKelas->buku->judul }}</p>
            <p><strong>Tanggal Pinjam:</strong> {{ $peminjamanKelas->tanggal_pinjam}}</p>
            <p><strong>Tanggal Kembali:</strong> {{ $peminjamanKelas->tanggal_kembali ? $peminjamanKelas->tanggal_kembali: 'Belum ditentukan' }}</p>
            <p><strong>Status:</strong> {{ $peminjamanKelas->status }}</p>
            <p><strong>Jumlah Buku:</strong> {{ $peminjamanKelas->jumlah_buku }} Buku</p>
            <p><strong>Denda:</strong> 
                @if($peminjamanKelas->status == 'Dipinjam')
                    @php
                        $denda = $peminjamanKelas->hitungDenda();
                    @endphp
                    @if($denda > 0)
                        <span class="text-danger font-weight-bold">Rp {{ number_format($denda, 0, ',', '.') }}</span>
                    @else
                        -
                    @endif
                @else
                    -
                @endif
            </p>
            <a href="{{ route('peminjaman_kelas.edit', $peminjamanKelas->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('peminjaman_kelas.destroy', $peminjamanKelas->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
            <a href="{{ route('peminjaman_kelas.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
