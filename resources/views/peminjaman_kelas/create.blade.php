@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mt-2">
        <div class="card-header">
            <h5 class="mb-0">Tambah Peminjaman Kelas</h5>
        </div>
        <div class="card-body">
            <!-- Menampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Menampilkan pesan error jika ada -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('peminjaman_kelas.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="user_id" class="form-label">Perwakilan Kelas</label>
                    <select id="user_id" name="user_id" class="form-select" required>
                        <option value="">Pilih Perwakilan</option>
                        @foreach($user as $u)
                            <option value="{{ $u->id }}">{{ $u->kelas }} - {{ $u->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="buku_id" class="form-label">Buku</label>
                    <select id="buku_id" name="buku_id" class="form-select" required>
                        <option value="">Pilih Buku</option>
                        @foreach($buku as $b)
                            <option value="{{ $b->id }}">{{ $b->judul }}</option>
                        @endforeach
                    </select>
                    @error('buku_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                    <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control" required>
                    @error('tanggal_pinjam')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                    <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control">
                    @error('tanggal_kembali')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jumlah_buku" class="form-label">Jumlah Buku</label>
                    <input type="number" id="jumlah_buku" name="jumlah_buku" class="form-control" required min="1">
                    @error('jumlah_buku')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
