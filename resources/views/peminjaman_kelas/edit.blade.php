@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mt-2">
        <div class="card-header">
            <h5 class="mb-0">Edit Peminjaman Kelas</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('peminjaman_kelas.update', $peminjamanKelas->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="user_id" class="form-label">Perwakilan Kelas</label>
                    <select id="user_id" name="user_id" class="form-select" required>
                        @foreach($user as $u)
                            <option value="{{ $u->id }}" {{ $u->id == $peminjamanKelas->user_id ? 'selected' : '' }}>
                                {{ $u->kelas }} - {{ $u->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="buku_id" class="form-label">Buku</label>
                    <select id="buku_id" name="buku_id" class="form-select" required>
                        @foreach($buku as $b)
                            <option value="{{ $b->id }}" {{ $b->id == $peminjamanKelas->buku_id ? 'selected' : '' }}>
                                {{ $b->judul }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                    <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control" value="{{ $peminjamanKelas->tanggal_pinjam}}" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                    <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control" value="{{ $peminjamanKelas->tanggal_kembali ? $peminjamanKelas->tanggal_kembali : '' }}">
                </div>
                <div class="mb-3">
                    <label for="jumlah_buku" class="form-label">Jumlah Buku</label>
                    <input type="number" id="jumlah_buku" name="jumlah_buku" class="form-control" value="{{ $peminjamanKelas->jumlah_buku }}" required min="1">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
